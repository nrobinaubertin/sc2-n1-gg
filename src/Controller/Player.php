<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Player as PlayerEntity;
use App\Entity\Match as MatchEntity;
use App\Entity\Earnings as EarningsEntity;
use Doctrine\ORM\EntityManagerInterface;

class Player extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

	/**
	 * @Route("/players/{id}/{category?}", name="player", requirements={"id"="\d+"})
	 **/
	public function indexAction(Request $request, string $id, ?string $category)
	{
        return $this->getPage($request, $id, $category);
	}

	/**
	 * @Route("/players/{id}-{tag?}", name="player_tag", requirements={"id"="\d+"})
	 **/
	public function indexTagAction(Request $request, string $id, ?string $tag)
	{
        return $this->getPage($request, $id, null);
	}

	/**
	 * @Route("/players/{id}-{tag?}/{category?}", name="player_tag_category", requirements={"id"="\d+"})
	 **/
	public function indexTagCategoryAction(Request $request, string $id, ?string $tag, ?string $category)
	{
        return $this->getPage($request, $id, $category);
	}

    private function getPage(Request $request, string $id, ?string $category)
    {
        $base_url = '/players/' . $id;
        switch ($category) {
            case 'results':
                return $this->getResults($request, $id);
            default:
                return $this->getSummary($request, $id);
        }
    }

    private function getResults(Request $request, string $id)
    {
        $player = $this->em->getRepository(PlayerEntity::class)->findOneById($id);

        if (empty($player)) {
            return $this->render('404.html.twig');
        }
        
        $date_query = '1 = 1';
        if (!empty($date_start = $request->get('date_start'))) {
            $date_query .= ' AND m.date >= :date_start';
        }
        if (!empty($date_end = $request->get('date_end'))) {
            $date_query .= ' AND m.date <= :date_end';
        }

        $opponent_races = [];
        if (empty($request->get('zerg')) || $request->get('zerg') == 'on') {
            $opponent_races[] = 'Z';
        }
        if (empty($request->get('terran')) || $request->get('terran') == 'on') {
            $opponent_races[] = 'T';
        }
        if (empty($request->get('protoss')) || $request->get('protoss') == 'on') {
            $opponent_races[] = 'P';
        }

        $match_type_query = '1 = 0'; // SQL hack to simplify construction of the query
        switch ($match_type = $request->get('match_type')) {
            case 'offline':
                $match_type_query .= ' OR m.offline = TRUE';
                break;
            case 'online':
                $match_type_query .= ' OR m.offline = FALSE';
                break;
            default:
                $match_type_query .= ' OR 1 = 1';
        }
        
        $match_format = [];
        $match_format_query = '1 = 0'; // SQL hack to simplify construction of the query
        if (empty($request->get('BO1')) || $request->get('BO1') == 'on') {
            $match_format[] = 'BO1';
            $match_format_query .= ' OR ((m.sca = 1 OR m.scb = 1) AND (m.sca + m.scb < 2))';
        }
        if (empty($request->get('BO3')) || $request->get('BO3') == 'on') {
            $match_format[] = 'BO3';
            $match_format_query .= ' OR ((m.sca = 2 OR m.scb = 2) AND (m.sca + m.scb < 4))';
        }
        if (empty($request->get('BO5')) || $request->get('BO5') == 'on') {
            $match_format[] = 'BO5';
            $match_format_query .= ' OR ((m.sca = 3 OR m.scb = 3) AND (m.sca + m.scb < 6))';
        }
        if (empty($request->get('BO7plus')) || $request->get('BO7plus') == 'on') {
            $match_format[] = 'BO7plus';
            $match_format_query .= ' OR (m.sca > 6 OR m.scb > 6)';
        }

        $query = $this->em->createQuery(
            'SELECT m
            FROM App\Entity\Match AS m
            WHERE (
                (m.pla = :id AND EXISTS (SELECT ob.race FROM App\Entity\Player AS ob WHERE ob.id = m.plb AND ob.race IN (:opponent_races)))
                OR (m.plb = :id AND EXISTS (SELECT oa.race FROM App\Entity\Player AS oa WHERE oa.id = m.plb AND oa.race IN (:opponent_races)))
            )
            AND ('.$match_type_query.')
            AND ('.$match_format_query.')
            AND ('.$date_query.')
            ORDER BY m.date DESC, m.id DESC'
        )->setParameter('id', $id)
         ->setParameter('opponent_races', $opponent_races);

        if (!empty($date_start)) {
            $query->setParameter('date_start', $date_start);
        }
        if (!empty($date_end)) {
            $query->setParameter('date_end', $date_end);
        }

        $matches = $query->execute();

        $total_maps = 0;
        $map_wins = 0;
        $match_wins = 0;

        foreach ($matches as $match) {
            $total_maps += $match->getSca() + $match->getScb();
            if ($match->getPla()->getId() == $player->getId()) {
                if ($match->getSca() > $match->getScb()) {
                    $match_wins++;
                }
                $map_wins += $match->getSca();
            } else {
                if ($match->getSca() < $match->getScb()) {
                    $match_wins++;
                }
                $map_wins += $match->getScb();
            }
        }

		return $this->render('player/base.html.twig', [
			'player' => $player,
            'matches' => $matches,
            'nav_active' => 'results',
            'base_url' => '/players/' . $player->getId(),
            'opponent_races' => $opponent_races,
            'match_type' => $match_type,
            'match_format' => $match_format,
            'match_wins' => $match_wins,
            'total_maps' => $total_maps,
            'map_wins' => $map_wins,
            'date_start' => $date_start,
            'date_end' => $date_end,
		]);
    }

    private function getSummary(Request $request, string $id)
    {
        $player = $this->em->getRepository(PlayerEntity::class)->findOneById($id);
        
        $matches = $this->em->createQuery(
            'SELECT m
            FROM App\Entity\Match as m
            WHERE m.pla = :id OR m.plb = :id
            ORDER BY m.date DESC, m.id DESC'
        )->setParameter('id', $id)->execute();

        if (empty($player) || empty($matches)) {
            return $this->render('404.html.twig');
        }

        $qb = $this->em->createQueryBuilder();
        
        $total_earnings = $this->em->createQuery(
            'SELECT SUM(e.earnings) as total_earnings
            FROM App\Entity\Earnings as e
            WHERE e.player = :id'
        )->setParameter('id', $id)->execute()[0]['total_earnings'];

        $match_wins = 0;
        $map_wins = 0;
        $total_maps = 0;
        $matches_month = [];

        // Prepare $matches_month keys
        $end = $matches[0]->getDate();
        $start = $curr = new \Datetime(end($matches)->getDate()->format('Y-m').'-01');
        while ($curr->getTimestamp() < $end->getTimestamp()) {
            $matches_month[$curr->getTimestamp()*1000] = [
                'total_matches' => 0,
                'total_wins' => 0,
            ];
            $curr->modify('+1 month');
        }
        $matches_month[$curr->getTimestamp()*1000] = [
            'total_matches' => 0,
            'total_wins' => 0,
        ];

        foreach ($matches as $match) {
            $matches_month[strtotime($match->getDate()->format('Y-m').'-01')*1000]['total_matches'] += 1;
            $total_maps += $match->getSca() + $match->getScb();
            if ($match->getPla()->getId() == $player->getId()) {
                if ($match->getSca() > $match->getScb()) {
                    $matches_month[strtotime($match->getDate()->format('Y-m').'-01')*1000]['total_wins'] += 1;
                    $match_wins++;
                }
                $map_wins += $match->getSca();
            } else {
                if ($match->getSca() < $match->getScb()) {
                    $matches_month[strtotime($match->getDate()->format('Y-m').'-01')*1000]['total_wins'] += 1;
                    $match_wins++;
                }
                $map_wins += $match->getScb();
            }
        }

        $player_age = $player->getBirthday()->diff(new \DateTime())->format('%a');
        $player_age = floor(intval($player_age)/365);

		return $this->render('player/base.html.twig', [
			'player' => $player,
            'matches' => $matches,
            'match_wins' => $match_wins,
            'total_maps' => $total_maps,
            'map_wins' => $map_wins,
            'total_earnings' => $total_earnings,
            'matches_month' => $matches_month,
            'nav_active' => 'summary',
            'base_url' => '/players/' . $player->getId(),
            'player_age' => $player_age,
		]);
    }
}

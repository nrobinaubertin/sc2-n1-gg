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
        if (!empty($after = $request->get('after'))) {
            $date_query .= ' AND m.date >= :after';
        }
        if (!empty($before = $request->get('before'))) {
            $date_query .= ' AND m.date <= :before';
        }

        $opponent_races = [];
        if (!empty($race = $request->get('race'))) {
            // compatibility with aligulac
            foreach (str_split($race) as $char) {
                $opponent_races[] = strtoupper($char);
            }
        } else {
            if (empty($request->get('zerg')) || $request->get('zerg') == 'on') {
                $opponent_races[] = 'Z';
            }
            if (empty($request->get('terran')) || $request->get('terran') == 'on') {
                $opponent_races[] = 'T';
            }
            if (empty($request->get('protoss')) || $request->get('protoss') == 'on') {
                $opponent_races[] = 'P';
            }
        }

        if (!empty($request->get('offline'))) {
            // compatibility with aligulac
            $match_type = $request->get('offline');
        } else {
            $match_type = $request->get('match_type');
        }

        $match_type_query = '1 = 0'; // SQL hack to simplify construction of the query
        switch ($match_type) {
            case 'offline':
                $match_type_query .= ' OR m.offline = TRUE';
                break;
            case 'online':
                $match_type_query .= ' OR m.offline = FALSE';
                break;
            default:
                $match_type_query .= ' OR 1 = 1';
        }
        
        // compatibility with aligulac
        $bestof = $request->get('bestof');

        $match_format = [];
        $match_format_query = '1 = 0'; // SQL hack to simplify construction of the query
        if (
            empty($bestof) && (
                empty($request->get('BO1'))
                || $request->get('BO1') == 'on'
            )
            || $bestof == "all"
        ) {
            $match_format[] = 'BO1';
            $match_format_query .= ' OR ((m.sca = 1 OR m.scb = 1) AND (m.sca + m.scb < 2))';
        }
        if (
            empty($bestof) && (
                empty($request->get('BO3'))
                || $request->get('BO3') == 'on'
            )
            || $bestof == "all"
            || $bestof == "3"
        ) {
            $match_format[] = 'BO3';
            $match_format_query .= ' OR ((m.sca = 2 OR m.scb = 2) AND (m.sca + m.scb < 4))';
        }
        if (
            empty($bestof) && (
                empty($request->get('BO5'))
                || $request->get('BO5') == 'on'
            )
            || $bestof == "all"
            || $bestof == "3"
            || $bestof == "5"
        ) {
            $match_format[] = 'BO5';
            $match_format_query .= ' OR ((m.sca = 3 OR m.scb = 3) AND (m.sca + m.scb < 6))';
        }
        if (
            empty($bestof) && (
                empty($request->get('BO7plus'))
                || $request->get('BO7plus') == 'on'
            )
            || $bestof == "all"
            || $bestof == "3"
            || $bestof == "5"
        ) {
            $match_format[] = 'BO7plus';
            $match_format_query .= ' OR (m.sca > 6 OR m.scb > 6)';
        }

        $event_query = '1 = 1';
        $event_join = '';
        if ($event = $request->get('event')) {
            $event_join = 'INNER JOIN m.eventobj e';
            $event_query .= ' AND lower(e.fullname) LIKE lower(:event)';
        }

        $query = $this->em->createQuery(
            'SELECT m
            FROM App\Entity\Match AS m
            '.$event_join.'
            WHERE (
                (m.pla = :id AND EXISTS (SELECT ob.race FROM App\Entity\Player AS ob WHERE ob.id = m.plb AND ob.race IN (:opponent_races)))
                OR (m.plb = :id AND EXISTS (SELECT oa.race FROM App\Entity\Player AS oa WHERE oa.id = m.pla AND oa.race IN (:opponent_races)))
            )
            AND ('.$match_type_query.')
            AND ('.$match_format_query.')
            AND ('.$date_query.')
            AND ('.$event_query.')
            ORDER BY m.date DESC, m.id DESC'
        )->setParameter('id', $id)
         ->setParameter('opponent_races', $opponent_races);

        if (!empty($after)) {
            $query->setParameter('after', $after);
        }
        if (!empty($before)) {
            $query->setParameter('before', $before);
        }
        if (!empty($event)) {
            $query->setParameter('event', '%'.$event.'%');
        }

        $matches = $query->execute();
        $results = $this->getMatchesResults($matches, $player);

		return $this->render('player/base.html.twig', [
			'player' => $player,
            'results' => $results,
            'nav_active' => 'results',
            'base_url' => '/players/' . $player->getId(),
            'opponent_races' => $opponent_races,
            'match_type' => $match_type,
            'match_format' => $match_format,
            'after' => $after,
            'before' => $before,
            'event' => $event,
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

        $results = $this->getMatchesResults($matches, $player);

        if (!empty($player->getBirthday())) {
            $player_age = $player->getBirthday()->diff(new \DateTime())->format('%a');
            $player_age = floor(intval($player_age)/365);
        }

		return $this->render('player/base.html.twig', [
			'player' => $player,
            'results' => $results,
            'nav_active' => 'summary',
            'base_url' => '/players/' . $player->getId(),
            'player_age' => $player_age ?? null,
            'total_earnings' => $total_earnings,
		]);
    }

    private function getMatchesResults(array $matches, PlayerEntity $player): array
    {
        $results = [
            "match_wins" => 0,
            "map_wins" => 0,
            "total_maps" => 0,
            "total_matches" => 0,
            "matches_month" => [],
            "events" => [],
            "last" => null,
            "first" => null,
        ];

        if (empty($matches)) {
            return $results;
        }

        $results["first"] = $matches[0];
        $results["last"] = end($matches);
        $results["recent_matches"] = array_slice($matches, 0, 10);
        $results["total_matches"] = count($matches);

        // Prepare $matches_month keys
        $end = $matches[0]->getDate();
        $start = $curr = new \Datetime(end($matches)->getDate()->format('Y-m').'-01');
        while ($curr->getTimestamp() < $end->getTimestamp()) {
            $results["matches_month"][$curr->getTimestamp()*1000] = [
                'total_matches' => 0,
                'total_wins' => 0,
            ];
            $curr->modify('+1 month');
        }
        $results["matches_month"][$curr->getTimestamp()*1000] = [
            'total_matches' => 0,
            'total_wins' => 0,
        ];

        foreach ($matches as $match) {

            // get the tournament id
            $event = $match->getEventObj();
            while ($event->getParent() && $event->getParent()->getType() != "category") {
                $event = $event->getParent();
            }

            // create the event in the event list if it doesn't exists
            if (!array_key_exists($event->getId(), $results["events"])) {
                $results["events"][$event->getId()] = [
                    "date" => $event->getEarliest(),
                    "name" => $event->getFullName(),
                    "matches" => [],
                ];
            }

            $results["events"][$event->getId()]["matches"][] = $match;

            // aggregate statistics about matches
            $results["matches_month"][strtotime($match->getDate()->format('Y-m').'-01')*1000]['total_matches'] += 1;
            $results["total_maps"] += $match->getSca() + $match->getScb();
            if ($match->getPla()->getId() == $player->getId()) {
                if ($match->getSca() > $match->getScb()) {
                    $results["matches_month"][strtotime($match->getDate()->format('Y-m').'-01')*1000]['total_wins'] += 1;
                    $results["match_wins"]++;
                }
                $results["map_wins"] += $match->getSca();
            } else {
                if ($match->getSca() < $match->getScb()) {
                    $results["matches_month"][strtotime($match->getDate()->format('Y-m').'-01')*1000]['total_wins'] += 1;
                    $results["match_wins"]++;
                }
                $results["map_wins"] += $match->getScb();
            }
        }

        return $results;
    }
}

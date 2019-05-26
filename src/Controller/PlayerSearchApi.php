<?php

namespace App\Controller;

use App\Entity\Earnings as EarningsEntity;
use App\Entity\Match as MatchEntity;
use App\Entity\Player as PlayerEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlayerSearchApi extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Request $request)
    {
        $search = $request->get('search');
        
        if (!empty($search)) {
            $players = $this->em->createQuery(
                'SELECT p AS player, COUNT(m.id) AS match_count
                FROM App\Entity\Player AS p
                JOIN App\Entity\Match as m WITH m.pla = p OR m.plb = p
                WHERE lower(p.tag) LIKE lower(:search)
                OR lower(p.aliases) LIKE lower(:search)
                GROUP BY p
                ORDER BY match_count DESC'
            )->setMaxResults(50)->setParameter('search', '%'.$search.'%')->execute();
        } else {
            $players = [];
        }

        $response = array_map(function ($p) {
            return [
                "id" => $p["player"]->getId(),
                "tag" => $p["player"]->getTag(),
                "country" => $p["player"]->getCountry(),
                "race" => $p["player"]->getRace(),
                "match_count" => $p["match_count"],
            ];
        }, $players);

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }
}

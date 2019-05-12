<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Player as PlayerEntity;
use App\Entity\Match as MatchEntity;
use Doctrine\ORM\EntityManagerInterface;

class Index extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

	/**
	 * @Route("/", name="index")
	 **/
	public function indexAction(Request $request)
	{
        $search = $request->get('search');
        
        if (!empty($search)) {
            $players = $this->em->createQuery(
                'SELECT p AS player, COUNT(m.id) AS match_count
                FROM App\Entity\Player AS p
                JOIN App\Entity\Match as m WITH m.pla = p OR m.plb = p
                WHERE lower(p.tag) LIKE lower(:search)
                GROUP BY p
                ORDER BY match_count DESC'
            )->setParameter('search', '%'.$search.'%')->execute();
        } else {
            $players = [];
        }
        
        return $this->render('index.html.twig', [
            'search' => $search,
            'players' => $players,
        ]);
	}
}

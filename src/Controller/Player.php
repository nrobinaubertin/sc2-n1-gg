<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Player extends AbstractController
{
	/**
	 * @Route("/players/{id}")
	 **/
	public function id($id)
	{
		return $this->render('player/id.html.twig', [
			'id' => $id,
		]);
	}
}

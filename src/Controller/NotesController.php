<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NotesController extends AbstractController
{

	public function index(): Response
	{
		return $this->render('base.html.twig');
	}

	public function display(): Response
	{
		$data = [['title' => 'First Title', 'body' => 'Lorem Ipsum One']];
		return $this->render('display.html.twig', [
			'data' => $data,
		]);
	}

	public function create(): Response
	{
		return $this->render('create.html.twig');
	}

}
<?php

namespace App\Controller;

use App\Entity\Notes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

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

	public function saveNote(Request $req): Response
	{
		$title = $req->request->get('title');
		$body = $req->request->get('body');

		$note = new Notes();
		$note->setTitle($title);
		$note->setBody($body);
		
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($note);
		$entityManager->flush();
		
		return $this->render('create.html.twig');
	}
}
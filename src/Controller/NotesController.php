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
		$notes = $this->getDoctrine()->getRepository(Notes::class)->findAll();
		return $this->render('display.html.twig', [
			'data' => $notes,
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
		
		return $this->redirectToRoute('display');
	}

	public function edit(Request $req): Response
	{
		$id = $req->attributes->get('id');

		$entityManager = $this->getDoctrine()->getManager();
		$note = $entityManager->getRepository(Notes::class)->find($id);

		return $this->render('update.html.twig', [
			'data' => $note
		]);
	}

	public function update(Request $req): Response
	{
		$id = $req->request->get('id');

		$entityManager = $this->getDoctrine()->getManager();
		$note = $entityManager->getRepository(Notes::class)->find($id);

		$title = $req->request->get('title');
		$body = $req->request->get('body');

		$note->setTitle($title);
		$note->setBody($body);

		$entityManager->flush();
		return $this->redirectToRoute('display');
	}

	public function delete(Request $req): Response
	{
		$id = $req->request->get('id');

		$entityManager = $this->getDoctrine()->getManager();
		$note = $entityManager->getRepository(Notes::class)->find($id);

		$entityManager->remove($note);
		$entityManager->flush();
	
		return $this->redirectToRoute('display');
	}
}
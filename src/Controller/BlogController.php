<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
	/**
	* @Route("/contact", name ="contact")
	*/
	public function contact()
	{
		$form = $this->createForm(ContactType::class);

		return $this->render('contact.html.twig', [
			'contact_form' => $form->createView()
		]);
	}
}
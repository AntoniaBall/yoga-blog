<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
	/**
	* @Route("/home"), name="homepage"
	*/
	public function index()
	{
		return $this->render('base.html.twig');
	}
}
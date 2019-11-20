<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
	/**
	* @Route("/list"), name ="listbillets"
	*
	*/
	public function getAllArticles()
	{
		//pss, repository !!
		$repository = $this->getDoctrine()
					->getRepository(Article::class);
		
		$articles = $repository->findAll();

		return $this->render('articles.html.twig',
			['articles' => $articles]);
	}
}

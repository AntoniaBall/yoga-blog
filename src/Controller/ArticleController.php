<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
	/**
	* @Route("/home", name ="listbillets")
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

	/**
	* @Route("/article/{articleId}", name="showArticle")
	*
	*/
	public function showArticle($articleId)
	{	
		$repository = $this->getDoctrine()
					->getRepository(Article::class);
		
		$article = $repository->find($articleId);

			return $this->render('article.html.twig',
			['article' => $article] );
	}
	
}

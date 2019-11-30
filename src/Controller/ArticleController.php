<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
	/**
	* @Route("/home", name ="home")
	*
	*/
	public function getAllArticles()
	{
		//pss, repository !!
		$repository = $this->getDoctrine()
					->getRepository(Article::class);
		
		$articles = $repository->findAllOrderByDate();

		return $this->render('articles.html.twig',
			['articles' => $articles]);
	}

	/**
	* @Route("/article/{articleId}", name="showArticle")
	*
	*/
	public function showArticle($articleId)
	{	
		$repository = $this-> getDoctrine()
						   ->getRepository(Article::class);

		$currentArticle = $repository->find($articleId);
		$previousArticle = $repository->getPreviousArticle($articleId);
		$nextArticle = $repository->getNextArticle($articleId);

		return $this->render('article.html.twig', [
				'article' => $currentArticle,
				'previousArticle' => $previousArticle,
				'nextArticle' => $nextArticle
		] );
	}
	
	/**
	* @Route("/add", name="add")
	*
	*/
	public function addArticle(Request $request)
	{
		// création formulaire à partir de Article Type
		$article = new Article();
        $article->setDate(new \Datetime('now'));

		// on crée un objet forme dans lequel sera mis le formulaire créé
		$form = $this->createForm(ArticleType::class, $article);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			$entitymanager = $this->getDoctrine()->getManager();
			$entitymanager->persist($article);
			$entitymanager->flush();

			$this->addFlash('success', 'Article ajouté avec succès');
		}

		return $this->render('articleadd.html.twig',[
			'form' => $form->createView()
		]);
	}
}

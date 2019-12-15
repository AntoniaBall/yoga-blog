<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategorySelectedType;
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
	public function list(Request $request)
	{
		$repository = $this->getDoctrine()
					->getRepository(Article::class);

		$articles = $repository->findAllOrderByDate();

		$form = $this->createForm(CategorySelectedType::class);
		$form->handleRequest($request);

		$category = $form->get('category')->getData();

		if(!$category)
		{
			//pss, repository !!
			$repository = $this->getDoctrine()
					->getRepository(Article::class);
		
			$articles = $repository->findAllOrderByDate();


			return $this->render('articles.html.twig',[
				'articles' => $articles,
				'form' => $form->createView()
			]);
		}

		else if($form->isSubmitted())
		{
			$articles = $category->getArticles();
			return $this->render('articles.html.twig', [
				'articles' => $articles,
				'form' => $form->createView()

			]);
		}
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

	/**
	* @Route("/api/articles", name="api_articles")
	*
	*/
	public function AllArticles()
	{
		$response = new Response();

		$articles = $this->getDoctrine()
							->getRepository(Article::class)
							->findAll();

		$articlesSerialized = [];

	    foreach ($articles as $article) {
	    	$articlesSerialized[] = 
	    	[
	    		'id' => $article->getId(),
	    		'title' => $article->getTitre(),
	    		'content' => $article->getContenu()
	    	];
	    }

	    $response->setContent(json_encode($articlesSerialized));

	    $response->headers->set('Content-Type', 'Application/Json');

	    return $response;
		// return new Response(json_encode($articlesSerialized));
	}
}

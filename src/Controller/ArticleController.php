<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategorySelectedType;
use App\Service\FileUploader;
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

		$form = $this->createForm(CategorySelectedType::class);
		$form->handleRequest($request);

		$category = $form->get('category')->getData();

		if(!$category)
		{
			$articles = $repository->findAllOrderByDate();
		}
		else{
			$articles = $category->getArticles();
		}
		
		return $this->render('articles.html.twig', [
				'articles' => $articles,
				'form' => $form->createView()
			]);
	}


	/**
	* @Route("/admin", name ="admin_home")
	*
	*/
	public function listAdmin(Request $request)
	{
		$repository = $this->getDoctrine()
					->getRepository(Article::class);

		$form = $this->createForm(CategorySelectedType::class);
		$form->handleRequest($request);

		$category = $form->get('category')->getData();

		if(!$category)
		{
			$articles = $repository->findAllOrderByDate();
		}
		else{
			$articles = $category->getArticles();
		}
		
		return $this->render('admin.html.twig', [
				'articles' => $articles,
				'form' => $form->createView()
			]);
	}

	/**
	* @Route("/article/{article}", name="showArticle")
	*/
	public function showArticle(Article $article)
	{	
		$repository = $this-> getDoctrine()
						   ->getRepository(Article::class);

		$previousArticle = $repository->getPreviousArticle($article->getId());
		$nextArticle = $repository->getNextArticle($article->getId());

		return $this->render('article.html.twig', [
				'article' => $article,
				'previousArticle' => $previousArticle,
				'nextArticle' => $nextArticle
		] );
	}
	
	/**
	* @Route("/admin/add", name="add")
	*
	*/
	public function addArticle(Request $request, FileUploader $fileUploader)
	{
		// création formulaire à partir de Article Type
		$article = new Article();
        $article->setDate(new \Datetime('now'));

		// on crée un objet forme dans lequel sera mis le formulaire créé
		$form = $this->createForm(ArticleType::class, $article);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			 /** @var UploadedFile $brochureFile */
        	$brochureFile = $form['brochure']->getData();
        	$entitymanager = $this->getDoctrine()->getManager();

        	if ($brochureFile) {
	            $brochureFileName = $fileUploader->upload($brochureFile);
	            $article->setBrochureFilename($brochureFileName);
			}
			$entitymanager->persist($article);
			$entitymanager->flush();
			$this->addFlash('success', 'Article ajouté avec succès');
			return $this->redirectToRoute("add");
		}

		return $this->render('articleadd.html.twig',[
			'form' => $form->createView()
		]);
	}

	/**
	* @Route("/admin/update/{article}", name ="update")
	*
	*/
	public function update(Request $request, Article $article)
	{
		$form = $this->createForm(ArticleType::class, $article);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
        	$brochureFile = $form['brochure']->getData();

        	$entitymanager = $this->getDoctrine()->getManager();
			
			if ($brochureFile) {
	        	$brochureFileName = $fileUploader->upload($brochureFile);
	            $article->setBrochureFilename($brochureFileName);
			}
			$entitymanager->persist($article);
			$entitymanager->flush();

			$this->addFlash('update_success', 'Article modifié avec succès !');

			return $this->redirectToRoute("update", [
				'article' => $article->getId()
			]);
		}

		return $this->render('articleupdate.html.twig', [
			'articleUpdated' => $article,
			'form' => $form->createView()
		]
		);
	}

	/**
	* @Route("/admin/delete/{article}", name ="delete")
	*
	*/
	public function delete(Request $request, Article $article)
	{
        $entitymanager = $this->getDoctrine()->getManager();
		$entitymanager->remove($article);
		$entitymanager->flush();
		return $this->redirectToRoute("admin_home");
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

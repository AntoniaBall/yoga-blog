<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategorySelectedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        return $this->render('articles.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
    * @Route("/categoryselected", name="selectedcategory")
    */
    public function showSelectedCategory(Request $request)
	{
		// on crée un objet forme dans lequel sera mis le formulaire créé
		$form = $this->createForm(CategorySelectedType::class);
		$form->handleRequest($request);

		if($form->isSubmitted())
		{
			$category = $form->get('category')->getData();
			$articles = $category->getArticles();
			return $this->render('articles.html.twig', [
				'articles' => $articles
			]);
		}
		return $this->render('category.html.twig',[
			'form' => $form->createView()
		]);
	}

}


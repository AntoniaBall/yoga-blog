<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // 10 data fixtures
    		for ($i=0; $i<10; $i++)
    	{	
    		$article = new Article();
    		$article->setTitre("10 bonnes raisons de se mettre au yoga");
    		$article->setContenu("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
		        		do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		        		Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris
		        		 nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor i
		        		  reprehenderit in voluptate velit essecillum dolore eu fugiat nulla 
		        		  pariatur. Excepteur sint occaecat cupidatat non
		        		proident, sunt in culpa qui officia deserunt mollit anim
		        		id est laborum.");
    		$article->setDate(new \Datetime('NOW'));

    		$manager->persist($article);
    	}

        $manager->flush();
    }
}
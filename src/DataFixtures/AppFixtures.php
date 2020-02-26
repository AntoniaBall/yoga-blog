<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
	private $categories;
	
	private $articles;

	private $manager;

    public function load(ObjectManager $manager)
    {
		$this->manager = $manager;
		$this->loadCategory();
		$this->loadArticles();
		$this->loadUser();
	}

	public function loadCategory()
	{
        for ($i=0; $i<2; $i++)
    	{	
    		$category = new Category();
			$category->setName("Category ".$i);
			$this->categories[$i] = $category;
			$this->manager->persist($category);
		}
		$this->manager->flush();

	}

	public function loadArticles()
	{
    	$currentDate = new \Datetime();
		for ($i=0; $i<30; $i++)
		{	
			$article = new Article();
    		$article->setTitre("10 bonnes raisons de se mettre au yoga");
    		$article->setContenu("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed-+
		        		do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
		        		Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris
		        		 nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor i
		        		  reprehenderit in voluptate velit essecillum dolore eu fugiat nulla 
		        		  pariatur. Excepteur sint occaecat cupidatat non
		        		proident, sunt in culpa qui officia deserunt mollit anim
		        		id est laborum.");
			$article->setDate($currentDate);
			$currentDate = $currentDate->modify('+1 day');

			$categoryCount = count($this->categories);
			$key = array_rand($this->categories);
			$article->setCategory($this->categories[$key]);

			$imagesFixtures = ["default/yoga1.jpg","default/yoga2.jpg", "default/yoga3.jpg"];
			$randimage = $imagesFixtures[array_rand($imagesFixtures)];
			$article->setImage($randimage);

			$this->manager->persist($article);
			$this->manager->flush();
    	}

	}
	public function loadUser()
    {
        // génère 1 user
        $user = new User();
        $user->setUsername('antonia');
        $user->setEmail("ranivoson.antonia@gmail.com");
        $user->setPassword('$2y$10$/QcdAhLhg5aRgKj4bHmeRuEUafL.CjcgW0vY8nQX6/NbR/KqsmWtO');
        $user->setEnabled('true');
    	$this->manager->persist($user);
        $this->manager->flush();
    }
}
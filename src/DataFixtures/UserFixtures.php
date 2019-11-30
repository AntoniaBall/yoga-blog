<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // génère 1 user
        $user = new User();
        $user->setUsername('antonia');
        $user->setEmail("ranivoson.antonia@gmail.com");
        $user->setPassword('$2y$10$/QcdAhLhg5aRgKj4bHmeRuEUafL.CjcgW0vY8nQX6/NbR/KqsmWtO');
        $user->setEnabled('true');
    	$manager->persist($user);
        $manager->flush();
    }
}
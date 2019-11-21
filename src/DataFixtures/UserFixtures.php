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
        $user->setPassword('test');

    	$manager->persist($user);
        $manager->flush();
    }
}
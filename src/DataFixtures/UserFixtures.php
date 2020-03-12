<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $username = "Toto";
        $mdp = password_hash("momo", PASSWORD_DEFAULT);
        $user = (new User)->setUsername($username)
                              ->setPassword($mdp)
                              ->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);

        $manager->flush();
    }
}

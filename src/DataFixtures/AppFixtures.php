<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create();

        $users = [];
        for ($i=0; $i <50 ; $i++) {
            $user = new User();
            $user->setUsername($faker->name);
            $user->setFistname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password());
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
            $users [] = $user;
        }

        $categories = [];
        for ($i=0; $i < 15 ; $i++) {
            $category = new Category();
            $category->setTitle($faker->realText(50));
            $category->setDescription($faker->realText(250));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i=0; $i <50 ; $i++) {
                $article = new Article();
                $article->setTitle($faker->realText(50));
                $article->setContent($faker->realText(6000));
                $article->setImage($faker->imageUrl());
                $article->setCreatAt(new \DateTime());
                $article->addCategory($categories[$faker->numberBetween(0,14)]);
                $article->setAuthor($users[$faker->numberBetween(0,49)]);
                $manager->persist($article);
            }
        
         $manager->flush();
    }
}

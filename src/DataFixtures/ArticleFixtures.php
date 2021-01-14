<?php

namespace App\DataFixtures;

use App\Entity\article;
use App\Entity\artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i <5 ; $i++) {

        $artist = new artist();
        $artist->setTitle("anything $i");
        $manager->persist($artist);

        for ($j=1; $j <=2 ; $j++){
            $article = new article();
            $article->setTitle("title $j")
            ->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt .")
           ->setCreatedAt(new \Datetime())
           ->setImage("media/1.jpg")
           ->setArtist($artist);

            $manager->persist($article);
         }
          
     }
        
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use DateTime;

use App\Entity\artist;
use App\Entity\article;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    //     $faker = Factory::create('fr');
    //     for($i=1; $i <5 ; $i++) {

    //     $artist = new artist();
    //     $artist->setTitle("anything $i");
    //     $manager->persist($artist);

    //     for ($j=1; $j <=2 ; $j++){
    //         $article = new article();
    //         $article->setTitle("title $j")
    //         ->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt .")
    //        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
    //        ->setImage("media/1.jpg")
    //        ->setArtist($artist);

    //         $manager->persist($article);
    //         $today = new DateTime();
    //         $diffrence = $today->diff($article->getCreatedAt());
    //         $days = $diffrence->days;
    //         $comment_maximum = '-'.$days. 'days';

            
    //         for($k=0; $k <= mt_rand(4,6); $k++) {
    //             $comment = new Comment();
    //             $comment->setAuteur($faker->name)
    //             ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt')
    //             ->setCreatedAt($faker->dateTimeBetween($comment_maximum))
    //             ->setArticle($article);
    //         $manager->persist($comment);
    //         }
    //      }
          
    //  }
        
    //     $manager->flush();
    // }
    }
}
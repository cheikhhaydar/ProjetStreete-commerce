<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StreetArtController extends AbstractController
{
    /**
     * @Route("/", name="street_art")
     */
    public function index(ArticleRepository $articleRepository): Response
    { 
        $articles = $articleRepository->findAll();
        
        return $this->render('street_art/index.html.twig', [
            'articles' => $articles
            
        ]);
    }
    /**
     * @Route("article/{id}" , name="afficher_article")
     */
    public function show(Article $article)
     {
        return $this->render('street_art/afficher.html.twig' , [
        'article' => $article  
        ]);
        
        
    }
}

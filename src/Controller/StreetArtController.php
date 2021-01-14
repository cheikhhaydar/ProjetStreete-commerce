<?php

namespace App\Controller;
use \DateTime;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("article/nouveau" , name="nouveau_aticle")
     */
    public function nouveau(Request $request)
    {   
        $article = new article();
         $form = $this->createForm(ArticleType::class, $article);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()) {
            $article->setCreatedAt(new DateTime());
            $article->setImage("https://img-3.journaldesfemmes.fr/OWLlp2tBpSg3moCG8zggEzJWsfA=/1240x/smart/b4fabf44fc2a4ca7bfda35ac05e52b4f/ccmcms-jdf/11089464.jpg");
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($article);
               $entityManager->flush();

               return $this->redirectToRoute("afficher_article" ,['id' => $article->getId() ]);
         }
        return $this->render('street_art/nouveau.html.twig', [
              'form' =>$form->createView()
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

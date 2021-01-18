<?php

namespace App\Controller;
use \DateTime;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentsType;
use PhpParser\Node\Expr\FuncCall;
use App\Repository\ArticleRepository;
use ProxyManager\Generator\Util\ProxiedMethodReturnExpression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("article/{id}" , name="afficher_article" , methods={"GET", "POST"})
     */
    public function show(Article $article ,Request $request)
         {
         $comment = new Comment();
         $form = $this->createForm(CommentsType::class, $comment);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()) {
             $comment->setCreatedAt(new DateTime());
             $comment->setArticle($article);
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($comment);
             $entityManager->flush();

             return $this->redirectToRoute("afficher_article" , ['id'=> $article->getId()]);

         }
         return $this->render('street_art/afficher.html.twig' , [
            
        'article' => $article,
        'commentform' => $form,
        'commentform' =>$form->createView()
        ]);
        
        
    }
   
}

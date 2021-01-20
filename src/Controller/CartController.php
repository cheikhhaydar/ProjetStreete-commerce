<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Entity\Article;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session , ArticleRepository $articleRepository)
    {
        $panier = $session->get('panier', []);
        $panierWithData = [];
        foreach($panier as $id =>$quantity) {
            $panierWithData[] = [
                'article' => $articleRepository->find($id),
                'quantity' => $quantity
            ];
        }
      $total = 0;
      foreach($panierWithData as $item) {
          $totalItem = $item['article']->getPrix() * $item['quantity'];
          $total = $total + $totalItem;
        }
        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
            
        ]);
        
    }
       /**
        * @Route("/panier/add/{id}", name="cart_add")
        */
    public function add($id, Request $request, SessionInterface $session) 
    {
        $session = $request->getSession();

        $panier = $session->get('panier' , []);
        if(!empty($panier[$id])) {
           $panier[$id]++;
 
        }else {
             $panier[$id] = 1;
        }

       

        $session->set('panier',$panier);
        return $this->redirectToRoute("cart_index");
        


    } 
    /**
     * @Route("/panier/remove/{id}" , name="remove_cart")
     */
    public Function remove($id , SessionInterface $session) 
     {
        $panier = $session->get('panier' , []);
         if(!empty($panier[$id])) {
             unset($panier[$id]); 

             }
         $session->set('panier', $panier);

         return $this->redirectToRoute("cart_index");

     }
}

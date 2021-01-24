<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MonEspaceController extends AbstractController
{
    /**
     * @Route("/mon/espace", name="mon_espace")
     */
    public function index(): Response
    {
        return $this->render('mon_espace/index.html.twig', [
            'controller_name' => 'MonEspaceController',
        ]);
    }

          
    
//     /**
//     * @Route("user/{id}editInfos", name="edit_infos")
//     */
// public function edit(Request $request, User $user) {
//     $form = $this->createForm(UserType::class, $user);
//     $form->handleRequest($request);
  
//     if ($form->isSubmitted() && $form->isValid()) {
//         $entityManager = $this->getDoctrine()->getManager();
//         $entityManager->persist($user);
//         $entityManager->flush();
//         return $this->redirectToRoute("mon_espace", ['id'=> $user->getId()]);
//     }
//     return $this->render('street_art/editUser.html.twig' , [
//         'editForm'=> $form->createView()
//     ]);
//   } 
}

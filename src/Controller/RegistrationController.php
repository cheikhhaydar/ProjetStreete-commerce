<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request)
    { 

        $user = new User();
        $form = $this->CreateForm(RegistrationType::class , $user);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response 
    { 

        $user = new User();
        $form = $this->CreateForm(RegistrationType::class , $user);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
           $user->setPassword(
               $passwordEncoder->encodePassword(
               $user,
               $form->get('Password')->getData() 
               )
              
               );

            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush(); 
            $this->addFlash('success', "Votre inscription est validée.");
            return $this->redirectToRoute('blog');

        

          

        }
        return $this->render('registration/index.html.twig', [
            'registrationform' => $form->createView()
        ]);
    }
}

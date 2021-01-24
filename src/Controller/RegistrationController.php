<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Url;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $passwordEncoder ,FlashyNotifier $flashyNotifier, MailerInterface $mailer): Response 
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

        //     $email = (new Email())
        //     ->from('hello@example.com')
        //     ->to('lepag18087@eamarian.com')
        //     //->cc('cc@example.com')
        //     //->bcc('bcc@example.com')
        //     //->replyTo('fabien@example.com')
        //     //->priority(Email::PRIORITY_HIGH)
        //     ->subject('Time for Symfony Mailer!')
        //     ->text('Sending emails is fun again!')
        //     ->html('<p>See Twig integration for better HTML integration!</p>');

        // $mailer->send($email);
           
            $flashyNotifier->success('Votre inscription est validée.'); 
            return $this->redirectToRoute('street_art');

        

          

        }
        return $this->render('registration/index.html.twig', [
            'registrationform' => $form->createView()
        ]);
    }
 
} 
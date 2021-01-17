<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
        ->add('firstName', TextType::class , [
           'label' => "Prénom"
        ])
        ->add('lastName', TextType::class , [
            'label' => "Nom"
        ])
        ->add('email')
        
        ->add('Password', RepeatedType::class , [
        'type' => PasswordType::class,
        'invalid_message' => 'Les mots de passe ne correspondent pas',
        'required' => true,
        'first_options'  => ['label' => 'Entrez votre mot de passe!'],
        'second_options' => ['label' => 'Entrez votre mot de passe à nouveau'], 
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}


 

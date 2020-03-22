<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password',RepeatedType::class, [
      'type' => PasswordType::class,
      'invalid_message' => 'Les mots de passe saisis ne correspondent pas.',
      'options' => ['attr' => ['class' => 'password-field']],
      'required' => true,
      'first_options'  => ['label' => 'Saisissez le une première fois...'],
      'second_options' => ['label' => 'Puis une deuxième fois...'],
    ])
            ->add('prenom')
            ->add('nom')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

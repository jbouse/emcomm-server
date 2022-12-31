<?php
namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Username',
                ],
                'row_attr' => [
                    'class' => 'shadow mb-3 rounded',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Password',
                ],
                'row_attr' => [
                    'class' => 'shadow mb-3 rounded',
                ],
            ])
            ->add('login', SubmitType::class, ['label' => 'Login'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'    => User::class,
            'sanitize_html' => true,
            'csrf_token_id' => 'authenticate',
        ]);
    }
}
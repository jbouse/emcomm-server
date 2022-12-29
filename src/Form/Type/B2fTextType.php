<?php
namespace App\Form\Type;

use App\Entity\B2fText;
use App\Entity\MobileProvider;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class B2fTextType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sender', TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Sender first and last name',
                ],
            ])
            ->add('recipient', NumberType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Recipient phone number',
                ],
            ])
            ->add('provider', EntityType::class, [
                'label'        => false,
                'class'        => MobileProvider::class,
                'choice_label' => 'name',
                'placeholder'  => 'Recipient mobile service provider',
            ])
            ->add('body', TextareaType::class, [
                'label' => false,
                'attr'  => [
                    'rows' => 3,
                    'maxlength' => 90,
                    'placeholder'  => 'Message (limit 90 characters)',
                ],
            ])
            ->add('send', SubmitType::class, ['label' => 'Send Text'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => B2fText::class,
            'sanitize_html' => true,
        ]);
    }
}
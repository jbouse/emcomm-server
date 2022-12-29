<?php
namespace App\Form\Type;

use App\Entity\B2fMessage;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class B2fMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sender', TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Sender first and last name',
                ],
                'row_attr' => [
                    'class' => 'shadow mb-3 rounded',
                ],
            ])
            ->add('recipient', EmailType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Recipient email address',
                ],
                'row_attr' => [
                    'class' => 'shadow mb-3 rounded',
                ],
            ])
            ->add('subject', TextType::class, [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Subject for the message',
                ],
                'row_attr' => [
                    'class' => 'shadow mb-3 rounded',
                ],
            ])
            ->add('body', TextareaType::class, [
                'label' => false,
                'attr'  => [
                    'rows' => 6, 
                    'placeholder'  => 'Message',
                ],
                'row_attr' => [
                    'class' => 'shadow mb-3 rounded',
                ],
            ])
            ->add('send', SubmitType::class, ['label' => 'Send Email'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'    => B2fMessage::class,
            'sanitize_html' => true,
        ]);
    }
}
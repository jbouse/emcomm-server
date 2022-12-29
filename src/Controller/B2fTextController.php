<?php
namespace App\Controller;

use App\Entity\B2fText;
use App\Form\Type\B2fTextType;
use App\Service\B2fMessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class B2fTextController extends AbstractController
{
    #[Route('/text', name: 'text_new')]
    public function new(Request $request, B2fMessageService $b2f): Response
    {
        $text = new B2fText();

        $form = $this->createForm(B2fTextType::class, $text);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $text = $form->getData();
            $message = $b2f->sendTextMessage($text);

            return $this->render('text/success.html.twig', [
                    'text' => $text,
                    'time' => date('Y/m/d h:i'),
                    'b2f'  => $message,
            ]);
        }

        return $this->render('text/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/text-queued', name: 'text_success')]
    public function success(B2fText $text): Response
    {
        return $this->render('text/success.html.twig', [
            'text' => $text,
        ]);
    }
}
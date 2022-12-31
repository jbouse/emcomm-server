<?php
namespace App\Controller;

use App\Entity\B2fMessage;
use App\Form\Type\B2fMessageType;
use App\Service\B2fMessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class B2fMessageController extends AbstractController
{
    #[Route('/email', name: 'email_new')]
    public function new(Request $request, B2fMessageService $b2f): Response
    {
        $email = new B2fMessage();

        $form = $this->createForm(B2fMessageType::class, $email);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->getData();
            $message = $b2f->sendEmailMessage($email);

            return $this->render('email/success.html.twig', [
                    'email' => $email,
                    'time' => date('Y/m/d h:i'),
                    'b2f' => $message,
            ]);
        }

        return $this->render('email/new.html.twig', [
            'form' => $form,
        ]);
    }

    // #[Route('/email-queued', name: 'email_success')]
    // public function success(B2fMessage $email): Response
    // {
    //     return $this->render('email/success.html.twig', [
    //         'email' => $email,
    //     ]);
    // }
}
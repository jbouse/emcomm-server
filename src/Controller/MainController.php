<?php
namespace App\Controller;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    #[Template('home.html.twig')]
    public function index() { return []; }

    #[Route('/about', name: 'about')]
    #[Template('about.html.twig')]
    public function about() { return []; }
}

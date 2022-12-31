<?php
namespace App\Controller;

use App\Entity\Bulletin;
use App\Repository\BulletinRepository;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private BulletinRepository $bulletinRepository;

    public function __construct(BulletinRepository $bulletinRepository)
    {
        $this->bulletinRepository = $bulletinRepository;
    }

    #[Route('/', name: 'homepage')]
    #[Template('home.html.twig')]
    public function index() {
        $bulletins = $this->bulletinRepository->findByState('published');

        return [
            'bulletins' => $bulletins,
        ]; 
    }

    #[Route('/about', name: 'about')]
    #[Template('about.html.twig')]
    public function about() { return []; }
}

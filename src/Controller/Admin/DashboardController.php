<?php

namespace App\Controller\Admin;

use App\Entity\Bulletin;
use App\Entity\MobileProvider;
use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EmComm Server')
            ->setFaviconPath('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-broadcast-pin" viewBox="0 0 16 16"><path d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707zm2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708zm5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708zm2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM6 8a2 2 0 1 1 2.5 1.937V15.5a.5.5 0 0 1-1 0V9.937A2 2 0 0 1 6 8z"/></svg>')
            ->generateRelativeUrls()
            ->setLocales(['en']);
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToRoute('EmComm Home', 'fa fa-home', 'homepage');

        yield MenuItem::subMenu('Entities', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Mobile Providers', 'fas fa-mobile-screen', MobileProvider::class),
            MenuItem::linkToCrud('Bulletins', 'fas fa-comment-dots', Bulletin::class),
            MenuItem::linkToCrud('Admin Users', 'fas fa-users', User::class),    
        ]);

        yield MenuItem::subMenu('Mailbox', 'fa fa-envelopes-bulk')->setSubItems([
            // MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class),
        ]);
    }
}

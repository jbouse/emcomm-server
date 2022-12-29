<?php
namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
    
    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        
        $menu->setChildrenAttribute('class', 'navbar-nav me-auto mb2 mb-1g-0');

        $menu
            ->addChild('Send Email', ['route' => 'email_new'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');
        $menu
            ->addChild('Send Text', ['route' => 'text_new'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');
        // $menu
        //     ->addChild('About', ['route' => 'about'])
        //     ->setAttribute('class', 'nav-item')
        //     ->setLinkAttribute('class', 'nav-link');

        return $menu;
    }
}
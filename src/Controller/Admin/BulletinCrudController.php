<?php

namespace App\Controller\Admin;

use App\Entity\Bulletin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class BulletinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bulletin::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->setEntityLabelInSingular('Bulletin')
            ->setEntityLabelInPlural('Bulletins')
            ->setPageTitle('index', '%entity_label_plural% listing')
            ->setPageTitle('new', 'Add a %entity_label_singular%')
            ->setAutofocusSearch()
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();
        yield ChoiceField::new('currentState')
            ->setChoices([
                'Draft' => 'draft',
                'Published' => 'published',
                'Expired' => 'expired',
            ]);
        yield DateTimeField::new('datetime', 'Date Time')
            ->hideWhenUpdating();
        yield TextareaField::new('content', 'Message');
    }

    public function createEntity(string $entityFqcn)
    {
        $bulletin = new Bulletin();
        $bulletin->setCurrentState('draft');

        return $bulletin;
    }
}

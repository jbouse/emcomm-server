<?php

namespace App\Controller\Admin;

use App\Entity\MobileProvider;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MobileProviderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MobileProvider::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_ADMIN')
            ->setEntityLabelInSingular('Mobile Provider')
            ->setEntityLabelInPlural('Mobile Providers')
            ->setPageTitle('index', '%entity_label_plural% listing')
            ->setPageTitle('new', 'Add a %entity_label_singular%')
            ->setAutofocusSearch()
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield TextField::new('emailSuffix');
    }
}

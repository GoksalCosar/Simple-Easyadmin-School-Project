<?php

namespace App\Controller\Admin;

use App\Entity\School;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SchoolCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return School::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('İsim Giriniz')->setHelp('İsim Giriniz'),
            DateTimeField::new('created_at'),
            BooleanField::new('is_active'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn(Action $action) => $action->setIcon('fa fa-file-alt')->setLabel('Okul Ekle'))
            ->update(Crud::PAGE_INDEX, Action::DETAIL,
                fn(Action $action) => $action->setIcon('fa-solid fa-list')->setLabel('Okullu Görüntüle'))
            ->update(Crud::PAGE_INDEX, Action::EDIT,
                fn(Action $action) => $action->setIcon('fa-solid fa-file-pen')->setLabel('Okulu Düzenle'))
            ->update(Crud::PAGE_INDEX, Action::DELETE,
                fn(Action $action) => $action->setIcon('fa-solid fa-trash')->setLabel('Okulu Sil'));
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Okul')
            ->setPageTitle('new', 'Okul Oluştur')
            ;
    }

}

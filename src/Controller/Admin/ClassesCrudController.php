<?php

namespace App\Controller\Admin;

use App\Entity\Classes;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClassesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Classes::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel("Sınıf İsmi"),
            DateTimeField::new('created_at'),
            BooleanField::new('is_active'),
            //AssociationField => Relation yapılan verileri listeleme
            AssociationField::new('school')->setLabel('Okul'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn(Action $action) => $action->setIcon('fa fa-file-alt')->setLabel('Sınıf Ekle'))
            ->update(Crud::PAGE_INDEX, Action::DETAIL,
                fn(Action $action) => $action->setIcon('fa-solid fa-list')->setLabel('Sınıfı Görüntüle'))
            ->update(Crud::PAGE_INDEX, Action::EDIT,
                fn(Action $action) => $action->setIcon('fa-solid fa-file-pen')->setLabel('Sınıfı Düzenle'))
            ->update(Crud::PAGE_INDEX, Action::DELETE,
                fn(Action $action) => $action->setIcon('fa-solid fa-trash')->setLabel('Sınıfı Sil'));
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Sınıf')
            ->setPageTitle('new', 'Sınıf Oluştur')
            ->setEntityLabelInSingular('Sınıf')

            ;
    }



}

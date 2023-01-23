<?php

namespace App\Controller\Admin;

use App\Entity\Lesson;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LessonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lesson::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel("Ders İsmi"),
            AssociationField::new('school')->setLabel('Okul'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn(Action $action) => $action->setIcon('fa fa-file-alt')->setLabel('Ders Ekle'))
            ->update(Crud::PAGE_INDEX, Action::DETAIL,
                fn(Action $action) => $action->setIcon('fa-solid fa-list')->setLabel('Dersi Görüntüle'))
            ->update(Crud::PAGE_INDEX, Action::EDIT,
                fn(Action $action) => $action->setIcon('fa-solid fa-file-pen')->setLabel('Dersi Düzenle'))
            ->update(Crud::PAGE_INDEX, Action::DELETE,
                fn(Action $action) => $action->setIcon('fa-solid fa-trash')->setLabel('Dersi Sil'));
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Ders')
            ->setPageTitle('new', 'Ders Kaydet')
            ;
    }



}

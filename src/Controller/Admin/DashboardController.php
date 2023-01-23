<?php

namespace App\Controller\Admin;

use App\Entity\Classes;
use App\Entity\Lesson;
use App\Entity\Note;
use App\Entity\School;
use App\Entity\Student;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(SchoolCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Okul Yönetim Sistemi');
    }

    public function configureMenuItems(): iterable
    {
        return [

            MenuItem::section('Blog'),
            MenuItem::linkToCrud('Okul', 'fa-sharp fa-solid fa-school', School::class),
            MenuItem::linkToCrud('Sınıf', 'fa-solid fa-book', Classes::class),
            MenuItem::linkToCrud('Öğrenci', 'fa-solid fa-graduation-cap', Student::class),
            MenuItem::linkToCrud('Not', 'fa-solid fa-clipboard', Note::class),
            MenuItem::linkToCrud('Ders', 'fa-solid fa-book', Lesson::class),
        ];
    }
}

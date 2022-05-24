<?php

namespace App\Controller\Admin;

use App\Entity\Rol;
use App\Entity\Usuario;
use App\Controller\Admin\RolCrudController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\UsuarioCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);


        return $this->redirect($routeBuilder->setController(UsuarioCrudController::class)->generateUrl());
        return $this->redirect($routeBuilder->setController(RolCrudController::class)->generateUrl());
        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ycarai');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Usuarios', 'fa fa-list',Usuario::class);
        yield MenuItem::linkToCrud('Roles', 'fa fa-list',Rol::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}

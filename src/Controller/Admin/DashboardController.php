<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Command;
use App\Entity\Commande;
use App\Entity\Dishes;
use App\Entity\Drinks;
use App\Entity\Menu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Api Kutiwa Test - Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        // Category Section
        yield MenuItem::section('Category', "fas fa-list-alt");
        yield MenuItem::subMenu('Action', "fas fa-bars")->setSubItems([
            MenuItem::linkToCrud('add Category', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Category', 'fas fa-eye', Category::class)
        ]);

        // Dishes Section
        yield MenuItem::section('Dishes', "fa-solid fa-bowl-food");
        yield MenuItem::subMenu('Action', "fas fa-bars")->setSubItems([
            MenuItem::linkToCrud('add Dishes', 'fas fa-plus', Dishes::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Dishes', 'fas fa-eye', Dishes::class)
        ]);

         // Dishes Section
         yield MenuItem::section('Menu', "fa-solid fa-utensils");
         yield MenuItem::subMenu('Action', "fas fa-bars")->setSubItems([
             MenuItem::linkToCrud('add Menu', 'fas fa-plus', Menu::class)->setAction(Crud::PAGE_NEW),
             MenuItem::linkToCrud('Show Menus', 'fas fa-eye', Menu::class)
         ]);

         yield MenuItem::section('Boissons', "fa-light fa-command");
         yield MenuItem::subMenu('Action', "fas fa-bars")->setSubItems([
             MenuItem::linkToCrud('add Beverage', 'fas fa-plus', Drinks::class)->setAction(Crud::PAGE_NEW),
             MenuItem::linkToCrud('Show Beverage', 'fas fa-eye', Drinks::class)
         ]);

         yield MenuItem::section('Commande', "fa-light fa-command");
         yield MenuItem::subMenu('Action', "fas fa-bars")->setSubItems([
             MenuItem::linkToCrud('add Commande', 'fas fa-plus', Command::class)->setAction(Crud::PAGE_NEW),
             MenuItem::linkToCrud('Show Commande', 'fas fa-eye', Command::class)
         ]);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}

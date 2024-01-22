<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use App\Controller\Admin\QuestionCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Entity\Classe;
use App\Entity\Matiere;
use App\Entity\Niveau;
use App\Entity\Professeur;

// TODO: Ajout de la sécurité d'accès au dashboard
// TODO: add a command for create new user-admin
// TODO: add a functionality for create a new admin user from the back-office

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(QuestionCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Le Cahier');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Questions', 'fas fa-list', Question::class);
        yield MenuItem::linkToCrud('Classes', 'fas fa-list', Classe::class);
        yield MenuItem::linkToCrud('Professeurs', 'fas fa-list', Professeur::class);
        yield MenuItem::linkToCrud('Niveaux', 'fas fa-list', Niveau::class);
        yield MenuItem::linkToCrud('Matières', 'fas fa-list', Matiere::class);

    }


}

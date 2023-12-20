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

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(QuestionCrudController::class)->generateUrl());

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
            ->setTitle('Le Cahier');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Questions', 'fas fa-list', Question::class);
        // yield MenuItem::linkToCrud('Niveaux', 'fas fa-list', Niveau::class);
        yield MenuItem::linkToCrud('Classes', 'fas fa-list', Classe::class);
        // yield MenuItem::linkToCrud('Professeurs', 'fas fa-list', Professeur::class);
        // yield MenuItem::linkToCrud('Matières', 'fas fa-list', Matiere::class);
        


        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}

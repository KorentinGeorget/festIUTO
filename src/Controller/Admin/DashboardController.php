<?php

namespace App\Controller\Admin;

use App\Controller\EvenementController;
use App\Entity\Evenement;
use App\Entity\Festival;
use App\Entity\Groupe;
use App\Entity\Hebergement;
use App\Entity\Instrument;
use App\Entity\LieuEvent;
use App\Entity\Membre;
use App\Entity\PossedeBillet;
use App\Entity\Spectateur;
use App\Entity\Style;
use App\Entity\TempsTransport;
use App\Entity\TypeBillet;
use App\Entity\TypeEvent;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
        return $this->render('pages/admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FestiIUTO')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Gestions d\'un festival');
        yield MenuItem::linkToCrud('Festival', 'fa-solid fa-calendar-days', Festival::class);
        yield MenuItem::linkToCrud('Evenement', 'fa-solid fa-calendar-day', Evenement::class);
        yield MenuItem::linkToCrud('LieuEvent', 'fa-solid fa-map-marker-alt', LieuEvent::class);
        yield MenuItem::linkToCrud('TempsTransport', 'fa-solid fa-car', TempsTransport::class);
        yield MenuItem::linkToCrud('TypeEvent', 'fa-solid fa-map-marker-alt', TypeEvent::class);



        yield MenuItem::section('Gestions des utilisateurs');
        yield MenuItem::linkToCrud('User', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Spectateur', 'fa-solid fa-user', Spectateur::class);
        yield MenuItem::linkToCrud('TypeBillet', 'fa-solid fa-ticket-alt', TypeBillet::class);
        yield MenuItem::linkToCrud('PossedeBillet', 'fa-solid fa-ticket-alt', PossedeBillet::class);
        yield MenuItem::linkToCrud('Membre', 'fa-solid fa-user', Membre::class);
        yield MenuItem::linkToCrud('Instrument', 'fa-solid fa-guitar', Instrument::class);
        yield MenuItem::linkToCrud('Groupe', 'fa-solid fa-people-group' , Groupe::class);
        yield MenuItem::linkToCrud('Style', 'fa-solid fa-music', Style::class);
        yield MenuItem::linkToCrud('Hebergement', 'fa-solid fa-hotel', Hebergement::class);




        yield MenuItem::section('');
        yield MenuItem::linkToRoute('Retour au site', 'fa-solid fa-arrow-left', 'home');

    }
}

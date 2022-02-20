<?php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController {

    #[Route('', name: 'admin_dashboard')]
    public function dashboard(): Response {
        return $this->render('admin/dashboard.html.twig');
    }
    #[Route('/dates', name: 'admin_dates')]
    public function dates(): Response {
        return $this->render('admin/dashboard.html.twig');
    }

    protected function render(string $view, array $parameters = [], Response $response = null): Response {
        $parameters['isAdmin'] = true;
        return parent::render($view, $parameters, $response);
    }
}

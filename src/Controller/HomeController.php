<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EventRepository $repository): Response
    {
        $events = $repository->findNextEvents();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'events' => $events
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Application;
use App\Form\ApplicationType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class ApplicationsController extends AbstractController
{
    #[Route('/apply/{event_id}', name: 'apply')]
    public function apply(int $event_id, Request $request, EventRepository $repo, EntityManagerInterface $entityManager): Response
    {
        $event = $repo->findOneBy(['id'=> $event_id]);
        if (empty($event)) {
            throw new NotFoundHttpException("Cet événement n'existe pas");
        }

        $application = new Application();
        $form = $this->createForm(ApplicationType::class,$application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $application->setEvent($event);

            $user = $this->getUser();
            $application->setUser($user);
            $application->setStatus('pending');

            $entityManager->persist($application);
            $entityManager->flush();
            return $this->redirectToRoute('application_ok');
        }

        return $this->renderForm('applications/apply.html.twig', [
            'event' => $event,
            'form' => $form
        ]);
    }

    #[Route('/application_ok', name: 'application_ok')]
    public function applicationOk () {
        return $this->render('applications/application_ok.html.twig');
    }
}

<?php
namespace App\Controller;

use App\Options\OptionsManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController {

    #[Route('', name: 'admin_dashboard')]
    public function dashboard(Request $request, OptionsManager $optionsManager): Response {
        $siteTitle = $optionsManager->getOption('site_title');
        $siteDescription = $optionsManager->getOption('site_description');

        $options = ['title' => $siteTitle, 'description' => $siteDescription];
        $form = $this->createFormBuilder($options)
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $optionsManager->setOption('site_title', $data['title']);
            $optionsManager->setOption('site_description', $data['description']);
        }


        return $this->renderForm('admin/dashboard.html.twig', [
            'form' => $form
        ]);
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

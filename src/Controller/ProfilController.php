<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{

    #[IsGranted('ROLE_USER')]
    #[Route('/profil', name: 'app_profil')]
    public function profil(EntityManagerInterface $em, Request $request): Response
    {
        $client = $this->getUser();

        $form = $this->createForm(ProfilType::class, $client);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $client = $form->getData();

            $em->flush();

            return $this->redirectToRoute('app_accueil');
            
        }
        return $this->render('profil/profil.html.twig', ['form' => $form]);
    }

}



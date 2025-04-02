<?php

namespace App\Controller;

use App\Entity\Commande;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FactureController extends AbstractController
{
    #[Route('/facture', name: 'app_facture')]
    public function afficherCommandes(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();


        $commandes = $em->getRepository(Commande::class)->findAll();


        $form = $this->createFormBuilder()
            ->add('facture', EntityType::class, [ 
                'class' => Commande::class,
                'choice_label' => 'ncom', 
                'placeholder' => 'Sélectionnez une facture',
            ])
            ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $facture = $form->get('facture')->getData(); 


            return $this->render('facture/details.html.twig', [
                'facture' => $facture 
            ]);
        }

        return $this->render('facture/index.html.twig', [
            'form' => $form->createView(),
            'commandes' => $commandes
        ]);
    }
}

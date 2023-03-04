<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Entity\SuiteHotel;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'suite_reservation')]
    public function single(Request $request, ManagerRegistry $doctrine, int $id): Response{
        $suiteRepository = $doctrine->getRepository(SuiteHotel::class); 
        $suite = $suiteRepository->find($id);

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $reservation=$form->getData();
            $entityManager->persist($resevration);
            $entityManager->flush();

            $this->addFlash(
                'reservation',
                'Votre reservation a bien étais envoyer !'
            );
        }

        return $this->render('reservation/index.html.twig', ['suite' => $suite, 'form' => $form]);
        
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Entity\SuiteHotel;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'suite_reservation')]
    public function add(Request $request, ManagerRegistry $doctrine, int $id): Response{
        $suiteRepository = $doctrine->getRepository(SuiteHotel::class); 
        $suite = $suiteRepository->find($id);

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation, ['suite' => $suite]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // Vérifier si la chambre est déjà réservée à la date de réservation
            $existingReservation = $suite->getReservations()->filter(function ($r) use ($reservation) {
                return $r->getDate() == $reservation->getDate();
            })->first();

            if ($existingReservation) {
                // Afficher une erreur dans le formulaire si la chambre est déjà réservée
                $form->get('date')->addError(new FormError('Cette chambre est déjà réservée à cette date.'));
            } else {
                $entityManager = $doctrine->getManager();

                $reservation=$form->getData();
                
                $reservation->setSuite($suite);
                $entityManager->persist($reservation);
                $entityManager->flush();

                $this->addFlash(
                    'reservation',
                    'Votre reservation a bien étais envoyer !'
                );
            }
        }

        return $this->render('reservation/index.html.twig', ['suite' => $suite, 'form' => $form]);
        
    }
}

<?php

namespace App\Controller;

use Symfony\component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\EtablissementHotel;
use App\Entity\SuiteHotel;

class HotelController extends AbstractController
{
    #[Route('/hotel/', name: 'hotel_list')]
    public function show(ManagerRegistry $doctrine): Response{
        $etablissementsRepository = $doctrine->getRepository(EtablissementHotel::class);
        $etablissements = $etablissementsRepository->findAll();
        return $this->render('hotel/index.html.twig', ['etablissements' => $etablissements]);
    }

    #[Route('/hotel/{id}', name: 'hotel_details')]
    public function single(ManagerRegistry $doctrine, int $id): Response{
        $etablissementsRepository = $doctrine->getRepository(EtablissementHotel::class); 
        $etablissement = $etablissementsRepository->find($id);

        return $this->render('hotel/details.html.twig', ['etablissement' => $etablissement]);
        
    }
}
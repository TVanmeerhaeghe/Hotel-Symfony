<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Contact;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $contact=$form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash(
                'contact',
                'Votre message a bien étais envoyer !'
            );
        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}

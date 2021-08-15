<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/contact", name="contact_")
 */
class ContactController extends AbstractController
{

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact;

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($contact);
            $em->flush();

            $this->addFlash('success', 'Votre message a été envoyé avec succès');
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
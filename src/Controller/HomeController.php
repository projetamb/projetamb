<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // Envoi d'un email
            $message = (new \Swift_Message('Mail'))
                ->setFrom($contact->getEmail())
                ->setTo('baratte.melisande@gmail.com')
                ->setBody($contact->getMessage(),
                    'text/html');

            $mailer->send($message);

            $this->addFlash('success', 'Votre Message a bien été envoyé !');
        }


        return $this->render('home/home.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

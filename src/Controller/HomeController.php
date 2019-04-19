<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\DisciplinesRepository;
use App\Repository\EntityRepository;
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
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function index(
        Request $request,
        \Swift_Mailer $mailer,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
    ){
        $contact = new Contact;
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        $entity = $entityRepository->findAll();
        $disciplines = $disciplinesRepository->findAll();

        if($form->isSubmitted() && $form->isValid()){

            // Envoi d'un email
            $message = (new \Swift_Message('Mail'))
                ->setFrom($contact->getEmail())
                ->setTo('baratte.melisande@gmail.com')
                ->setBody($contact->getMessage(),
                    'text/plain');

            $mailer->send($message);
            $this->addFlash('success', 'Votre Message a bien été envoyé !');
        }


        return $this->render('home/home.html.twig', [
            'form' => $form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines
        ]);
    }


}

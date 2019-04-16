<?php

namespace App\Controller;

use App\Repository\EventsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/event", name="event")
     */
    public function show(EventsRepository $eventsRepository)
    {
        $event= $eventsRepository->findAll();

        return $this->render('event/event.html.twig', [
            'controller_name' => 'EventController',
            'event'=>$event
        ]);
    }
}
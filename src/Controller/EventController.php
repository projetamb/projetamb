<?php

namespace App\Controller;

use App\Repository\EntityRepository;
use App\Repository\EventsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/event", name="event")
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function show(
        EventsRepository $eventsRepository,
        EntityRepository $entityRepository
){
        $event= $eventsRepository->findByDate();
        $entity = $entityRepository->findAll();
        return $this->render('event/event.html.twig', [
            'controller_name' => 'EventController',
            'event'=>$event,
            'entitys' => $entity,
        ]);
    }

}

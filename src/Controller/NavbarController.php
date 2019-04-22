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

class NavbarController extends AbstractController
{
    /**
     * @Route("/navbar", name="navbar")
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function index(
        EntityRepository $entityRepository
    ){
        $entity = $entityRepository->findAll();

        return $this->render('navbar/_navbar.html.twig', [
            'controller_name' => 'NavbarController',
            'entitys' => $entity
        ]);
    }
}

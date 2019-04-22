<?php

namespace App\Controller;

use App\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{


    /**
     * @Route("/footer", name="footer")
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function index(
        EntityRepository $entityRepository
    ){
        $entity = $entityRepository->findAll();
        return $this->render('footer/_footer.html.twig', [
            'controller_name' => 'FooterController',
            'entitys' => $entity

        ]);
    }
}

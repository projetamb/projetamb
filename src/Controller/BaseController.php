<?php

namespace App\Controller;

use App\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/base", name="base")
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function index(
        EntityRepository $entityRepository
    ){
        $entity = $entityRepository->findAll();
        return $this->render('base.html.twig', [
            'entitys' => $entity,
        ]);
    }
}

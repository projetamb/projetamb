<?php

namespace App\Controller;

use App\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ErrorsController extends AbstractController
{
    /**
     * @Route("/404", name="404")
     * @param EntityRepository $entityRepository
     */
    public function index(
        EntityRepository $entityRepository
    ){
        $entity = $entityRepository->findAll();
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig', [
            'entitys' => $entity,
        ]);
    }
}

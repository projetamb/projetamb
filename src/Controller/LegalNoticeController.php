<?php

namespace App\Controller;

use App\Repository\DisciplinesRepository;
use App\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    /**
     * @Route("/legal_notice", name="legal_notice")
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function legal(
        EntityRepository $entityRepository
    ){
        $entity = $entityRepository->findAll();
        return $this->render('legal_notice/legal_notice.html.twig',[
            'entitys' => $entity
        ]);

    }
}

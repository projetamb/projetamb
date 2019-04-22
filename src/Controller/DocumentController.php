<?php

namespace App\Controller;

use App\Repository\EntityRepository;
use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{
    /**
     * @Route("/document", name="document")
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function show(
        FilesRepository $filesRepository,
        EntityRepository $entityRepository
){
        $files = $filesRepository->findAll();
        $entity = $entityRepository->findAll();
        return $this->render('document/doc.html.twig', [
            'files' => $files,
            'entitys' => $entity,
        ]);
    }
}

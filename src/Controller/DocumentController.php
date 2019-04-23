<?php

namespace App\Controller;

use App\Repository\DisciplinesRepository;
use App\Repository\EntityRepository;
use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{
    /**
     * @Route("/document", name="document")
     * @param FilesRepository $filesRepository
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function show(
        FilesRepository $filesRepository,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
){
        $files = $filesRepository->findAll();
        $entity = $entityRepository->findAll();
        $disciplines = $disciplinesRepository->findAll();
        return $this->render('document/doc.html.twig', [
            'files' => $files,
            'entitys' => $entity,
            'discipliness' => $disciplines,
        ]);
    }
}

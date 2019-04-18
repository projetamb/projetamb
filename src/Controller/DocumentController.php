<?php

namespace App\Controller;

use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DocumentController extends AbstractController
{
    /**
     * @Route("/document", name="document")
     */
    public function show(FilesRepository $filesRepository)
    {
        $files = $filesRepository->findAll();
        return $this->render('document/doc.html.twig', [
            'files' => $files
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Personnal;
use App\Repository\FilesRepository;
use App\Repository\PersonnalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     * @param PersonnalRepository $personnalRepository
     * @param FilesRepository $filesRepository
     * @return Response
     */
    public function show(PersonnalRepository $personnalRepository)
    {
        $personnal = $personnalRepository->findAll();
        return $this->render('club/club.html.twig', [
            'personnals' => $personnal

        ]);
    }

}

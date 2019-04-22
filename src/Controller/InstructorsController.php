<?php

namespace App\Controller;

use App\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PersonnalRepository;
use App\Entity\Personnal;

class InstructorsController extends AbstractController
{
    /**
     * @Route("/instructors", name="instructors")
     * @param EntityRepository $entityRepository
     * @return Response
     */
    public function instructors(
        PersonnalRepository $personnalRepository,
        PersonnalRepository $instructors,
        EntityRepository $entityRepository
    ) {
        $repo = $this->getDoctrine()->getRepository(Personnal::class);

        $instructors = $repo->findByRole('Instructeur');
        $entity = $entityRepository->findAll();
        return $this->render('instructors/instructors.html.twig', [
            'controller_name' => 'InstructorsController',
            'instructeur' => $instructors,
            'entitys' => $entity,
        ]);
    }
}

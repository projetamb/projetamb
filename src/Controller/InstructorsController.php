<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PersonnalRepository;
use App\Entity\Personnal;

class InstructorsController extends AbstractController
{
    /**
     * @Route("/instructors", name="instructors")
     */
    public function instructors(
        PersonnalRepository $personnalRepository,
        PersonnalRepository $instructors
    ) {
        $repo = $this->getDoctrine()->getRepository(Personnal::class);

        $instructors = $repo->findByRole('Instructeur');
        return $this->render('instructors/instructors.html.twig', [
            'controller_name' => 'InstructorsController',
            'instructeur' => $instructors,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InstructorsController extends AbstractController
{
    /**
     * @Route("/instructors", name="instructors")
     */
    public function index()
    {
        return $this->render('instructors/index.html.twig', [
            'controller_name' => 'InstructorsController',
        ]);
    }
}

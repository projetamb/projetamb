<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    public function index()
    {
        return $this->render('club/club.html.twig', [
            'pagetitle' => 'Art Martiaux Basséens',
        ]);
    }
}

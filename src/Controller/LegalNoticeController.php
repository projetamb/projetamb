<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LegalNoticeController extends AbstractController
{
    /**
     * @Route("/legal_notice", name="legal_notice")
     */
    public function legal()
    {
        return $this->render('legal_notice/legal_notice.html.twig');
    }
}

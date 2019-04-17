<?php

namespace App\Controller;

use App\Entity\Events;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 *
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="security_admin")
     *
     */
    public function admin()
    {


        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/event", name="security_FormEvent")
     * @param Request $request
     * @param ObjectManager $manager
     */
    public function form(Request $request, ObjectManager $manager)
    {
        $evenement = new Events();
        // je crée un form qui est est lié a mon évenement
        $form= $this->createFormBuilder($evenement)
                    ->add('title')
                    ->add('place')
                    ->add('organisator')
                    ->add('description')
                    ->add('date',DateType::class)
                    ->add('email_contact')
                    ->add('phone_contact')
                    ->add('photo',FileType::class)
                    ->getForm();
        $form->handleRequest($request);
            dump($request);
            /*if($form->isSubmitted() && $form->isValid()){
                $manager->persist($form);
                $manager->flush();
            }*/
        return $this->render('admin/formEvent.html.twig',[
            'formEvent'=>$form->createView()
        ]);
    }
}

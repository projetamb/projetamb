<?php

namespace App\Controller;

use App\Entity\Events;
use App\Entity\Personnal;
use App\Entity\Product;
use App\Form\EventType;
use App\Form\InstructorType;
use App\Form\ProductType;
use App\Service\FileUpLoader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

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

    /******************************************************************************
     * Création du formulaire pour les instructeurs
     *******************************************************************************
    **
     * @Route("/admin/event", name="security_FormEvent")
     * creation de la route pour les evenements et du formulaire d'ajout d'évenement
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */

    public function create(Request $request, ObjectManager $manager,FileUpLoader $fileUpLoader)
    {
        $evenement = new Events();
      //  $form=$this->createForm(EventType::class,$evenement);
        // je crée un form qui est est lié a mon évenement
       $form= $this->createFormBuilder($evenement)
                    ->add('title')
                    ->add('place')
                    ->add('organisator')
                    ->add('description')
                    ->add('date',DateType::class)
                    ->add('email_contact',EmailType::class)
                    ->add('phone_contact')
                    ->add('photo',FileType::class)
                    ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $file=$evenement->getPhoto();
                $fileName = $fileUpLoader->upload($file);
                $evenement->setPhoto($fileName);
                $manager->persist($evenement);
                $manager->flush();

            }
        return $this->render('admin/formEvent.html.twig',[
            'formEvent'=>$form->createView()
        ]);
    }
    /******************************************************************************
     * Création du formulaire pour les instructeurs
     *******************************************************************************
    **
     * @Route("/admin/instructor", name="security_FormInstructor")
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @return Response
     */
    public function createFormInstructor(Request $request,ObjectManager $manager,FileUpLoader $fileUpLoader)
    {
        $instructor= new Personnal();
        $form=$this->createForm(InstructorType::class,$instructor);
        $form->handleRequest($request);
        dump($form);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=$instructor->getPhoto();
            $fileName = $fileUpLoader->upload($file);
            $instructor->setPhoto($fileName);
            $manager->persist($instructor);
            $manager->flush();

        }
        return $this->render('admin/formInstructor.html.twig',[
            'formInstructor'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/event/edit/{$id}",name="event_edit")
     * @param Request $request
     * @param Events $events
     *
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Events $events,FileUpLoader$fileUpLoader)
    {
        $form = $this->createForm(EventType::class, $events,FileUpLoader::class);

        //analyse de la requete
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          // $events->setTitle($events);

            // Le persist est optionnel
           // $this->getDoctrine()->getManager()->flush();
           // $this->addFlash('success', 'Evenement '.$events->getId().' a bien été modifié.');

            return $this->redirectToRoute('/');
        }

        return $this->render('admin/formEvent.html.twig', [
            'event' => $events,
            'form' => $form->createView()
        ]);
    }
    /******************************************************************************
     * Effecement d'un évenement
     *******************************************************************************
    *
     * @Route("/admin/event/{id}",name="event_delete", methods={"POST"})
     * @param Request $request
     * @param Events $events
     * @return RedirectResponse
     */
    public function deleteEvent(Request $request, Events $events)
    {
       if (!$this->isCsrfTokenValid('delete', $request->get('token'))) {
            return $this->redirectToRoute('/');
        }
        // $em = $entityManager
        $em = $this->getDoctrine()->getManager();
        $em->remove($events);
        $em->flush();
        $this->addFlash('success', 'Evenement '.$events->getTitle().' a bien été supprimé');

        return $this->redirectToRoute('home');
    }

    /******************************************************************************
     * Effecement d'un membre du bureau
     *******************************************************************************
    *
     * @Route("/admin/club/{id}", name="club_delete", methods={"POST"})
     * @param Request $request
     * @param Personnal $personnal
     * @return RedirectResponse
     */
    public function deleteClub(Request $request, Personnal $personnal)
    {
        if (!$this->isCsrfTokenValid('delete', $request->get('token'))) {
            return $this->redirectToRoute('/');
        }
        // $em = $entityManager
        $em = $this->getDoctrine()->getManager();
        $em->remove($personnal);
        $em->flush();
        $this->addFlash('success', 'la fonction '.$personnal->getRole().' a bien été supprimée');

        return $this->redirectToRoute('home');
    }
    /**********************************************************************************/
    /**
     * @Route("/admin/instructors/{id}",name="instructors_delete", methods={"POST"})
     * @param Request $request
     * @param Personnal $personnal
     * @return RedirectResponse
     */
    public function deleteInstructor(Request $request, Personnal $personnal)
    {
        if (!$this->isCsrfTokenValid('delete', $request->get('token'))) {
            return $this->redirectToRoute('/');
        }
        // $em = $entityManager
        $em = $this->getDoctrine()->getManager();
        $em->remove($personnal);
        $em->flush();
        $this->addFlash('success', 'la fonction '.$personnal->getRole().' a bien été supprimée');

        return $this->redirectToRoute('home');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}

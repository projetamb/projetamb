<?php

namespace App\Controller;

use App\Entity\Events;
use App\Entity\Product;
use App\Form\EventType;
use App\Form\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
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

    /**
     * @Route("/admin/event", name="security_FormEvent")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $evenement = new Events();
        $form=$this->createForm(EventType::class,$evenement);
        // je crée un form qui est est lié a mon évenement
       /* $form= $this->createFormBuilder($evenement)
                    ->add('title')
                    ->add('place')
                    ->add('organisator')
                    ->add('description')
                    ->add('date',DateType::class)
                    ->add('email_contact')
                    ->add('phone_contact')
                    ->add('photo',FileType::class)
                    ->getForm();*/
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($form);
                $manager->flush();

            }
        return $this->render('admin/formEvent.html.twig',[
            'formEvent'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/event/edit/{$id}",name="event_edit")
     * @param Request $request
     * @param Events $events
     *
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Events $events)
    {
        $form = $this->createForm(EventType::class, $events);

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

    /**
     * @Route("/admin/event/{id}",name="event_delete", methods={"POST"})
     * @param Request $request
     * @param Events $events
     * @return RedirectResponse
     */
    public function delete(Request $request, Events $events){
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

}

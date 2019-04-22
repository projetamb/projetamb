<?php

namespace App\Controller;

use App\Entity\Events;
use App\Entity\Personnal;
use App\Entity\Product;
use App\Form\EventType;
use App\Form\InstructorType;
use App\Form\MemberType;
use App\Form\ProductType;
use App\Repository\DisciplinesRepository;
use App\Repository\EntityRepository;
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
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     *
     */
    public function admin(
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
    ){

        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
            'entitys' => $entity,
            'discipliness' => $disciplines
        ]);
    }

    /**
     * @Route("/admin/member",name="securityFormMember")
     * @param Personnal $personnal
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
        public function formMember(

                                           Request $request,
                                           ObjectManager $manager,
                                           FileUpLoader $fileUpLoader,
                                           EntityRepository $entityRepository,
                                           DisciplinesRepository $disciplinesRepository
        )
        {
            $disciplines = $disciplinesRepository->findAll();
            $entity = $entityRepository->findAll();
            $personnal=new Personnal();
            $form  =$this->createForm(MemberType::class,$personnal);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $file=$personnal->getPhoto();
                $fileName = $fileUpLoader->upload($file);
                $personnal->setPhoto($fileName);
                $manager->persist($personnal);
                $manager->flush();
                return $this->redirectToRoute('club');
            }
            return $this->render("admin/formMember.html.twig",[
                'FormMember'=>$form->createView()
            ]);


        }



    /**
     *
     * @Route("/admin/event", name="security_FormEvent")
     * @Route("/admin/event/{id}/edit", name="security_formEventEdit")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */

    public function formEvent(
       // Events $events ,
        Request $request,
        ObjectManager $manager,
        FileUpLoader $fileUpLoader,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();

       // si j'ai pas d'evenemnt, j'en crée un
        //if( !$events){
            $events = new Events();
        //}

        dump($events);

       $form  =$this->createForm(EventType::class,$events);
        // je crée un form qui est est lié a mon évenement
       /*$form= $this->createFormBuilder($evenement)
                    ->add('title')
                    ->add('place')
                    ->add('organisator')
                    ->add('description')
                    ->add('date',DateType::class)
                    ->add('email_contact',EmailType::class)
                    ->add('phone_contact')
                    ->add('photo',FileType::class)
                    ->getForm();*/

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $file=$events->getPhoto();
                $fileName = $fileUpLoader->upload($file);
                $events->setPhoto($fileName);
                $manager->persist($events);
                $manager->flush();
                return $this->redirectToRoute('event');
            }
        return $this->render('admin/formEvent.html.twig',[
            'formEvent'=>$form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines,
          //  'editMode'=>$evenement->getId()!==null,// permet de savoir si je suis en edit ou en new.
        ]);
    }
    /**
     * @Route("/admin/instructor", name="security_FormInstructor")
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function createFormInstructor(
        Request $request,
        ObjectManager $manager,
        FileUpLoader $fileUpLoader,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        $instructor= new Personnal();
        //je relie mon formulaire à la class instructeur => me permet de récuperer les champs de la table personnal
        $form=$this->createForm(InstructorType::class,$instructor);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $file=$instructor->getPhoto();
            $fileName = $fileUpLoader->upload($file);
            $instructor->setPhoto($fileName);
            $manager->persist($instructor);
            $manager->flush();

        }
        return $this->render('admin/formInstructor.html.twig',[
            'formInstructor'=>$form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines

        ]);
    }

     /**
     * @Route("/admin/event/{id}",name="event_delete", methods={"POST"})
     * @param Request $request
     * @param Events $events
     * @return RedirectResponse
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function deleteEvent(
        Request $request,
        Events $events,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
    ){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();

       if (!$this->isCsrfTokenValid('delete', $request->get('token'))) {
            return $this->redirectToRoute('event',[
                'entitys' => $entity,
                'discipliness' => $disciplines
            ]);
        }
        // $em = $entityManager
        $em = $this->getDoctrine()->getManager();
        $em->remove($events);
        $em->flush();
        $this->addFlash('success', 'Evenement '.$events->getTitle().' a bien été supprimé');

        return $this->redirectToRoute('event',[
            'entitys' => $entity,
            'discipliness' => $disciplines
        ]);



    }

    /**
     * @Route("/admin/club/{id}", name="club_delete", methods={"POST"})
     * @param Request $request
     * @param Personnal $personnal
     * @return RedirectResponse
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function deleteClub(
        Request $request,
        Personnal $personnal,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        if (!$this->isCsrfTokenValid('delete', $request->get('token'))) {
            return $this->redirectToRoute('home',[
                'entitys' => $entity,
                'discipliness' => $disciplines
            ]);
        }
        // $em = $entityManager
        $em = $this->getDoctrine()->getManager();
        $em->remove($personnal);
        $em->flush();
        $this->addFlash('success', 'la fonction '.$personnal->getRole().' a bien été supprimée');

        return $this->redirectToRoute('home',[
            'entitys' => $entity,
            'discipliness' => $disciplines
        ]);
    }

    /**
     * @Route("/admin/instructors/{id}",name="instructors_delete", methods={"POST"})
     * @param Request $request
     * @param Personnal $personnal
     * @return RedirectResponse
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function deleteInstructor(
        Request $request,
        Personnal $personnal,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        if (!$this->isCsrfTokenValid('delete', $request->get('token'))) {
            return $this->redirectToRoute('/',[
                'entitys' => $entity,
                'discipliness' => $disciplines
            ]);
        }
        // $em = $entityManager
        $em = $this->getDoctrine()->getManager();
        $em->remove($personnal);
        $em->flush();
        $this->addFlash('success', 'la fonction '.$personnal->getRole().' a bien été supprimée');

        return $this->redirectToRoute('home',[
            'entitys' => $entity,
            'discipliness' => $disciplines
        ]);
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

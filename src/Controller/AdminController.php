<?php

namespace App\Controller;

use App\Entity\Entity;
use App\Entity\Disciplines;
use App\Entity\Events;
use App\Entity\Files;
use App\Entity\Personnal;
use App\Entity\Product;
use App\Form\DisciplinesType;
use App\Form\EntityType;
use App\Form\EventType;
use App\Form\InstructorType;
use App\Form\MemberType;
use App\Form\ProductType;
use App\Form\FilesType;
use App\Repository\DisciplinesRepository;
use App\Repository\EntityRepository;
use App\Repository\FilesRepository;
use App\Service\FileUpLoader;
use Doctrine\Common\Persistence\ObjectManager;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use GuzzleHttp\Client;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
            'discipliness' => $disciplines,
        ]);
    }
    /*************************************************************************
     *  Creation et modification d'un membre via le même form
     * On utilise 2 routes une pour la creation et une pour la modif
     *
     *************************************************************************/

    /**
     * @Route("/admin/member",name="securityFormMember")
     * @Route("/admin/member/{id}/edit", name="security_FormMemberEdit")
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
                                           DisciplinesRepository $disciplinesRepository,
                                           Personnal $personnal=null
                                 )
        {
            $disciplines = $disciplinesRepository->findAll();
            $entity = $entityRepository->findAll();
            //si je suis pas en mode modif je crée un nouveau membre
            if(!$personnal)
            {
                $personnal=new Personnal();
            }

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
                'FormMember'=>$form->createView(),
                'entitys' => $entity,
                'discipliness' => $disciplines,
                'editMode'=>$personnal->getId()!==null,// permet de savoir si je suis en edit ou en new.
            ]);


        }

    /*************************************************************************
     *  Creation et modification d'un evenement via le même form
     * On utilise 2 routes une pour la creation et une pour la modif
     *
     *************************************************************************/

    /**
     *
     * @Route("/admin/event", name="security_FormEvent")
     * @Route("/admin/event/{id}/edit", name="security_formEventEdit")
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @param SessionInterface $session
     * @param Events|null $events
     * @return Response
     * @throws \Google_Exception
     */

    public function formEvent(
        Request $request,
        ObjectManager $manager,
        FileUpLoader $fileUpLoader,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository,
        SessionInterface $session,
        Events $events = NULL
        )
        {
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();

       // si j'ai pas d'evenemnt, j'en crée un
        if( !$events){
            $events = new Events();
        }

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

                /** ******************************************************************************
                 * Debut GOOGLE CALENDAR
                 ******************************************************************************* */
                $client = new \Google_Client();
                $client->setAuthConfig('../client_secret.json');
                $client->addScope(\Google_Service_Calendar::CALENDAR_EVENTS);

                $guzzleClient = new Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
                $client->setHttpClient($guzzleClient);

                if ($session->get('access_token')){
                    $client->setAccessToken($session->get('access_token'));
                    $service = new Google_Service_Calendar($client);

                    // modèle
                    $event = new Google_Service_Calendar_Event(array(
                        'summary' => $events->getTitle(),
                        'location' => $events->getPlace(),
                        'description' => $events->getDescription(),
                        'start'=> array(
                            'date' => $events->getDate(),
                            'timeZone' => 'Europe/Paris'
                        ),
                        'end' => array(
                            'date' => $events->getDate()+1,
                            'timeZone' => 'Europe/Paris'
                        ),
                        'endTimeUnspecified' => true,
                        'organizer' => $events->getEmailContact(),

                    ));

                    // primary = calendrier principal
                    $calendarId = 'primary';
                    $service->events->insert($calendarId, $event);

                } else{
                    return $this->redirectToRoute('oauth'); // redirection vers authentication
                }
                /** ******************************************************************************
                 * Fin GOOGLE CALENDAR
                 ********************************************************************************* */


                return $this->redirectToRoute('event');
            }
        return $this->render('admin/formEvent.html.twig',[
            'formEvent'=>$form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines,
           'editMode'=>$events->getId()!==null,// permet de savoir si je suis en edit ou en new.
        ]);
    }


    /*************************************************************************
     *  Creation et modification d'un instructeur via le même form
     * On utilise 2 routes une pour la creation et une pour la modif
     *
     *************************************************************************/

    /**
     * @Route("/admin/instructor", name="security_FormInstructor")
     * @Route("/admin/instructor/{id}/edit", name="security_FormInstructeurEdit")
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function FormInstructor(
        Request $request,
        ObjectManager $manager,
        FileUpLoader $fileUpLoader,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository,
        Personnal $instructor=null
        )
    {
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        //si j'ai pas d'instructeur j'en crée un
        if(!$instructor)
        {
            $instructor= new Personnal();
        }

        //je relie mon formulaire à la class instructeur => me permet de récuperer les champs de la table personnal
        $form=$this->createForm(InstructorType::class,$instructor);
      //  $fileexist=$instructor->getPhoto();
        $form->handleRequest($request);
       // $file=$instructor->getPhoto();

        if($form->isSubmitted() && $form->isValid())
        {
            //if(!$fileexist || !$file){
                $file=$instructor->getPhoto();
                $fileName = $fileUpLoader->upload($file);
                $instructor->setPhoto($fileName);
         //  }

            $manager->persist($instructor);
            $manager->flush();
            return $this->redirectToRoute('instructors');
        }
        return $this->render('admin/formInstructor.html.twig',[
            'formInstructor'=>$form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines,
            'editMode'=>$instructor->getId()!==null,// permet de savoir si je suis en edit ou en new.

        ]);
    }




    /**
     * @Route("/admin/entity", name="security_FormEntity")
     * @Route("/admin/entity/{id}/edit", name="security_FormEntityEdit")
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function formEntity(
        Request $request,
        ObjectManager $manager,
        FileUpLoader $fileUpLoader,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository,
        Entity $entityy=null
    ){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        // si j'ai pas d'Entity, j'en crée une
        if( !$entityy){
            $entityy= new Entity();
        }

        //je relie mon formulaire ç la class entity => me permet de récuperer les champs de la table entity
        $form=$this->createForm(EntityType::class,$entityy);
        $form->handleRequest($request);
        dump($form);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=$entityy->getLogo();
            $fileName = $fileUpLoader->upload($file);
            $entityy->setLogo($fileName);
            $file=$entityy->getLogopage();
            $fileName = $fileUpLoader->upload($file);
            $entityy->setLogopage($fileName);
            $file=$entityy->getPhotobandeau();
            $fileName = $fileUpLoader->upload($file);
            $entityy->setPhotobandeau($fileName);
            $manager->persist($entityy);
            $manager->flush();
            return $this->redirectToRoute('home');

        }
        return $this->render('admin/formEntity.html.twig',[
            'formEntity'=>$form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines,
            'editMode'=>$entityy->getId()!==null,// permet de savoir si je suis en edit ou en new.

        ]);

    }

    /**
     * @Route("/admin/disciplines", name="security_FormDisciplines")
     * @Route("/admin/disciplines/{id}/edit", name="security_formDisciplinesEdit")
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function formDisciplines(
        Request $request,
        ObjectManager $manager,
        FileUpLoader $fileUpLoader,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository,
        Disciplines $discipliness = NULL
    ){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        // si j'ai pas de discipline, j'en crée une
        if( !$discipliness){
            $discipliness= new Disciplines();
        }

        //je relie mon formulaire ç la class disciplines => me permet de récuperer les champs de la table disciplines
        $form=$this->createForm(DisciplinesType::class,$discipliness);
        $form->handleRequest($request);
        dump($form);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($discipliness);
            $manager->flush();
            return $this->redirectToRoute('club');

        }
        return $this->render('admin/formDisciplines.html.twig',[
            'formDisciplines'=>$form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines,
            'editMode'=>$discipliness->getId()!==null,// permet de savoir si je suis en edit ou en new.
        ]);
    }

    /**
     * @Route("/admin/files", name="security_FormFiles")
     * @param Request $request
     * @param ObjectManager $manager
     * @param FileUpLoader $fileUpLoader
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function createFormFiles(
        Request $request,
        ObjectManager $manager,
        FileUpLoader $fileUpLoader,
        EntityRepository $entityRepository,
        DisciplinesRepository $disciplinesRepository
    ){
        $disciplines = $disciplinesRepository->findAll();
        $entity = $entityRepository->findAll();
        $files= new Files();
        //je relie mon formulaire à la class files => me permet de récuperer les champs de la table files
        $form=$this->createForm(FilesType::class,$files);
        $form->handleRequest($request);
        dump($form);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=$files->getLink();
            $fileName = $fileUpLoader->upload($file);
            $files->setLink($fileName);
            //$fileSize = $files->getSize();
            $manager->persist($files);
            $manager->flush();
            return $this->redirectToRoute('document');

        }
        return $this->render('admin/formFiles.html.twig',[
            'formFiles'=>$form->createView(),
            'entitys' => $entity,
            'discipliness' => $disciplines

        ]);
    }



    /**
     * @Route("/admin/disciplines/{id}",name="disciplines_delete", methods={"POST"})
     * @param Request $request
     * @param Disciplines $discipliness
     * @return RedirectResponse
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function deleteDisciplines(
        Request $request,
        Disciplines $discipliness,
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
        $em->remove($discipliness);
        $em->flush();
        $this->addFlash('success', 'Discipline '.$discipliness->getName().' a bien été supprimée');

        return $this->redirectToRoute('home',[
            'entitys' => $entity,
            'discipliness' => $disciplines
        ]);
    }

    /**
     * @Route("/admin/document/{id}",name="document_delete", methods={"POST"})
     * @param Request $request
     * @param Files $document
     * @return RedirectResponse
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return Response
     */
    public function deleteDocument(
        Request $request,
        Files $document,
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
        $em->remove($document);
        $em->flush();
        $this->addFlash('success', 'Document '.$document->getTitle().' a bien été supprimé');

        return $this->redirectToRoute('home',[
            'entitys' => $entity,
            'discipliness' => $disciplines
        ]);



    }
    /******************************************************************
     *  methode pour supprimer un evenement
     *
     *
     ******************************************************************/

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

    /******************************************************************
     *  methode pour supprimer un club
     *
     *
     ******************************************************************/

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
    /******************************************************************
     *  methode pour supprimer un instructeur
     *
     *
     ******************************************************************/


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

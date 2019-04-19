<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\DisciplinesRepository;
use App\Repository\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityRepository $entityRepository
     * @param DisciplinesRepository $disciplinesRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * USerPasswordInterface permet d'encoder les MDP
     * @return Response
     */
   public function registration(
       Request $request,
       ObjectManager $manager,
       UserPasswordEncoderInterface $encoder,
       EntityRepository $entityRepository,
       DisciplinesRepository $disciplinesRepository
   ){
       $disciplines = $disciplinesRepository->findAll();
       $entity = $entityRepository->findAll();
       $user = new User(); // utilisateur vide
       //on relie les champs de l'utilisateurs au formulaire
        $form= $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);// je veux que le formulaire analyse la requete que je lui passe

        if ($form->isSubmitted() && $form->isValid())
        {
            //on demande d'encoder les MDP situés dans la class user. dans le security.yml on a le lien avec encoder
            // dès que l'on a encoder, on va dans le fichier yml et on regarde sur quelle class on fait la relation. ici c'est la clss user
            $hash=$encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);// user je modifie ton MDP avec le hash
            $user->setTypeRole("ROLE_USER");
            $manager->persist($user);
            $manager->flush();
            // on redirige vers la page d'acceuil
            return $this->redirectToRoute('security_login');
        }
            return $this->render('security/registration.html.twig',[
                'form'=> $form->createView(),
                'entitys' => $entity,
                'discipliness' => $disciplines
            ]);
   }



    /**
     * @Route("/login",name="security_login")
     *
     */
   public function loginAction(
       AuthenticationUtils $authenticationUtils,
       EntityRepository $entityRepository,
       DisciplinesRepository $disciplinesRepository
){
       $disciplines = $disciplinesRepository->findAll();
       $entity = $entityRepository->findAll();
       // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();

       // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();
  /* $this->addFlash(
           'information',
           'Connexion reussie'
       );*/
       return $this->render('security/login.html.twig', [
           'last_username' => $lastUsername,
           'error'         => $error,
           'entitys' => $entity,
           'discipliness' => $disciplines
       ]);

   }

    /**
     * @Route("/logout", name="security_logout")
     */
      public function logout(){

   }
}

<?php

namespace App\Controller;

use App\Form\RegistrationType;
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
     * @return \Symfony\Component\HttpFoundation\Response
     * USerPasswordInterface permet d'encoder les MDP
     */
   public function registration(Request $request,ObjectManager $manager,UserPasswordEncoderInterface $encoder)
   {
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
            $manager->persist($user);
            $manager->flush();
            //
            return $this->redirectToRoute('security_login');
        }
            return $this->render('security/registration.html.twig',[
                'form'=> $form->createView()
            ]);
   }



    /**
     * @Route("/login",name="security_login")
     *
     */
   public function loginAction(AuthenticationUtils $authenticationUtils)
   {
       // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();

       // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();
       $this->addFlash(
           'information',
           'Connexion reussie'
       );
       return $this->render('security/login.html.twig', [
           'last_username' => $lastUsername,
           'error'         => $error,
       ]);

   }

    /**
     * @Route("/logout", name="security_logout")
     */
      public function logout(){

   }
}

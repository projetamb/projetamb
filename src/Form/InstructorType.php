<?php

namespace App\Form;

use App\Entity\Personnal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstructorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom de l\'instructeur',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom de l\'instructeur',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email de l\'instructeur',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone de l\'instructeur',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse de l\'instructeur',
            ])
            ->add('role',ChoiceType::class, [
                'choices'  => [
                    'Instructeur' => 'Instructeur',],
                'label' => 'Role',
            ])
            ->add('grade',ChoiceType::class, [
                'choices'  => [
                    '1er Dan' => '1er Dan',
                    '2ème Dan' => '2ème Dan',
                    '3ème Dan' => '3ème Dan',
                    '4ème Dan' => '4ème Dan',
                    '5ème Dan' => '5ème Dan',
                    '6ème Dan' => '6ème Dan',
                    '7ème Dan' => '7ème Dan',
                    '8ème Dan' => '8ème Dan',
                    '9ème Dan' => '9ème Dan',
                    'Expert' => 'Expert',],
                'label' => 'Grade de l\'instructeur',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'instructeur',
            ])
            ->add('link', TextType::class, [
                'label' => 'Lien Internet de l\'instructeur',
            ])
             ->add('photo',FileType::class, [
                'data_class' => null,
                 'label' => 'Photo de l\'instructeur',
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnal::class,
        ]);
    }
}

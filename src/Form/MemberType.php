<?php

namespace App\Form;

use App\Entity\Personnal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom du membre',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom du membre',
            ])
            ->add('email',EmailType::class, [
                'label' => 'Email du membre',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone du membre',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse du membre',
            ])
            ->add('role',ChoiceType::class, [
                'choices'  => [
                    'Président' => 'Président',
                    'Vice-Président' => 'Vice-Président',
                    'Secrétaire' => 'Secrétaire',
                    'Vice-Secrétaire' => 'Vice-Secrétaire',
                    'Trésorier' => 'Trésorier',
                    'Vice-Trésorier' => 'Vice-Trésorier',
                    'Chargé de communication' => 'Chargé de communication',],
                'label' => 'Role du membre',
            ])
            ->add('grade',ChoiceType::class, [
                'choices'  => [
                    'Non pratiquant' => 'Non pratiquant',
                    'Pratiquant non gradé' => 'Pratiquant non gradé',
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
                'label' => 'Grade du membre',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du membre',
             ])
            ->add('link', TextType::class, [
                  'label' => 'Lien Internet du membre',
              ])
            ->add('photo',FileType::class, [
                'data_class' => null,
                'label' => 'Photo du membre',
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

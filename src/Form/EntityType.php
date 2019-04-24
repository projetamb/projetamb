<?php

namespace App\Form;

use App\Entity\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Nom de la structure',
                ])
            ->add('Type', TextType::class, [
                'label' => 'Type de structure',
                ])
            ->add('Adress', TextType::class, [
                'label' => 'Adresse',
                ])
            ->add('Postalcity', TextType::class, [
                'label' => 'Code postal, Ville',
                ])
            ->add('Descriptive', TextareaType::class, [
                'label' => 'Description de la structure',
                ])
            ->add('Email',EmailType::class, [
                'label' => 'Email de la structure',
                ])
            ->add('Facebook', TextType::class, [
                'label' => 'Facebook de la structure',
                ])
            ->add('Directorname', TextType::class, [
                'label' => 'Nom du responsable',
                ])
            ->add('Directorphone', TextType::class, [
                'label' => 'Téléphone du responsable',
                ])
            ->add('Directoremail',EmailType::class, [
                'label' => 'Email du responsable',
                ])
            ->add('Logo',FileType::class, [
                'data_class' => null,
                'label' => 'Logo de la structure',
                ])
            ->add('Logopage',FileType::class, [
                'data_class' => null,
                'label' => 'Logo pâle de la page Club',
                 ])
            ->add('Photobandeau',FileType::class, [
                'data_class' => null,
                'label' => 'Photo bandeau',
                ])
            ->add('Color', ChoiceType::class,[
                'choices' => [
                    'gris' => 'grey',
                ],
                'label' => 'Couleur des fonds de page',
                ])
            ->add('Linkmap', TextType::class, [
                'label' => 'Lien Google Map',
                  ])



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entity::class,
        ]);
    }
}

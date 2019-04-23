<?php

namespace App\Form;

use App\Entity\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Type')
            ->add('Adress')
            ->add('Postalcity')
            ->add('Descriptive')
            ->add('Email',EmailType::class)
            ->add('Facebook')
            ->add('Directorname')
            ->add('Directorphone')
            ->add('Directoremail',EmailType::class)
            ->add('Logo',FileType::class)
            ->add('Logopage',FileType::class)
            ->add('Photobandeau',FileType::class)
            ->add('Color', ChoiceType::class,[
                'choices' => [
                    'gris' => 'grey',
                ]
            ])
            ->add('Linkmap')



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entity::class,
        ]);
    }
}

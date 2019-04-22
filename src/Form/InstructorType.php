<?php

namespace App\Form;

use App\Entity\Personnal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstructorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('phone')
            ->add('address')
            ->add('role',ChoiceType::class, [
                'choices'  => [
                    'Instructeur' => 'Instructeur',
                ]])
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
                    'Expert' => 'Expert',
                ]])
            ->add('description')
            ->add('link')
          ->add('photo',FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnal::class,
        ]);
    }
}

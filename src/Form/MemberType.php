<?php

namespace App\Form;

use App\Entity\Personnal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email',EmailType::class)
            ->add('phone')
            ->add('address')
            ->add('role',ChoiceType::class, [
                'choices'  => [
                    'Président' => 'Président',
                    'Vice-Président' => 'Vice-Président',
                    'Secrétaire' => 'Secrétaire',
                    'Vice-Secrétaire' => 'Vice-Secrétaire',
                    'Trésorier' => 'Trésorier',
                    'Vice-Trésorier' => 'Vice-Trésorier',
                    'Chargé de communication' => 'Chargé de communication',

                ]])
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
                    'Expert' => 'Expert',
                    ]])
            ->add('description')
            ->add('link')
            ->add('photo',FileType::class, array(
                'data_class' => null,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnal::class,
        ]);
    }
}

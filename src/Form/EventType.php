<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
//class contenant la logique du formulaire
class EventType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{


    $builder
        ->add('title')
        ->add('place')
        ->add('organisator')
        ->add('description')
        ->add('date',DateType::class)
        ->add('email_contact')
        ->add('phone_contact')
        ->add('photo')
        ;
   // parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
}
}
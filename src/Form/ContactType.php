<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Department;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'contact.name'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'contact.firstname'
            ])
            ->add('email', EmailType::class, [
                'label' => 'contact.email'
            ])
            ->add('message', TextareaType::class, [
                'label' => 'contact.message'
            ])
            ->add('department', EntityType::class, [
                'label' => 'contact.department',
                'placeholder' => 'contact.labelName',
                'class' => Department::class,
                'choice_label' => function(Department $department){
                    return $department->getName();
                }
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'contact.submit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

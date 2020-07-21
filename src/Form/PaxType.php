<?php

namespace App\Form;

use App\Entity\Pax;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\ChildType;



class PaxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Firstname' ])
            ->add('prenom', TextType::class, [
                'label' => 'Lastname' ])
            ->add('cin', NumberType::class, [
                'label' => 'CIN' ])
            ->add('phone', NumberType::class, [
                'label' => 'Phone' ])
            ->add('nombre_de_enfant', NumberType::class, [
                'label' => 'Child Number' ])
            ->add('father_name', ChildType::class,[
                'label'=> false ])
            ->add('sex', ChoiceType::class, [
                'label' => 'Gender',
                'placeholder' => '',
                'attr' => ['class' => 'form-check-label sex'],
                'choices' => [
                    'male'   => 'male',
                    'female' => 'female'
                ]
            ])
            ->add('date_de_naissance', DateType::class, [
                'label' => 'Date of Birth',
                'format' => 'yyyy-MM-dd',
                "widget" => 'single_text',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('Next', SubmitType::class, [
    'attr' => ['class' => 'btn btn-primary'],
     ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pax::class,
        ]);
    }
}

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

class PaxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom' ])
            ->add('prenom')
            ->add('cin')
            ->add('nombre_de_enfant')
            ->add('numero_de_chambre')
            ->add('sex', ChoiceType::class, [
                'label' => 'Gender',
                'placeholder' => '',
                'attr' => ['class' => 'form-check-label sex'],
                'choices' => [
                    'male'   => 1,
                    'female' => 0
                ]
            ])
            ->add('date_de_naissance', DateType::class, [
                'format' => 'yyyy-MM-dd',
                "widget" => 'single_text',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('save', SubmitType::class, [
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

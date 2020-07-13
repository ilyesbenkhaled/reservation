<?php

namespace App\Form;

use App\Entity\Pax;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PaxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('cin')
            ->add('nombre_de_enfant')
            ->add('numero_de_chambre')
            ->add('sex')
            ->add('date_de_naissance')
            ->add('save', SubmitType::class, [
    'attr' => ['class' => 'save'],
     ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pax::class,
        ]);
    }
}

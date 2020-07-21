<?php

namespace App\Form;

use App\Entity\Chambre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', NumberType::class, [
                'label' => 'Room Number' ])
            ->add('prix_de_base', TextType::class, [
                'label' => 'Starting Price' ])
            ->add('prix_exeptionnel', TextType::class, [
                'label' => 'Exceptional price' ])
            ->add('nombre_de_personne', NumberType::class, [
                'label' => 'Person Number' ])
            ->add('type', TextType::class, [
                'label' => 'Room Type' ])
            ->add('etage', TextType::class, [
                'label' => 'Floors' ])
            ->add('save', SubmitType::class, [
    'attr' => ['class' => 'btn btn-primary'],
     ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}

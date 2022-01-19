<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Location;
use App\Entity\Property;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class LocationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bien', EntityType::class, [
                'class' => Property::class,
                'attr' => [
                    'class' => 'form-control',
                ],
                'choice_label' => 'slug',
                'placeholder' => 'Selectionner un bien',
                'label' => 'Bien',
            ])
            ->add('libelle', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Libelle',
            ])
            ->add('loyer', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Loyer',
            ])
            ->add('caution', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Caution',
            ])
            ->add('avance', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Avance',
            ])
            ->add('dateDebut', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Date de Debut',
            ])
            ->add('dateFin', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Date de Fin',
            ]);
    }
}
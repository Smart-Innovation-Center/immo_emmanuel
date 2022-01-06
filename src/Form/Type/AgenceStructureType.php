<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Agences;
use App\Entity\Structures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class AgenceStructureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
         
            ->add('libelle', null, [
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control',
                ],
                'label' => 'Nom de l\'agence',
            ])
            ->add('email', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'email',
            ])
            ->add('contact', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'contact',
            ])
            ->add('adresse', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'adresse',
            ]);
    }
}
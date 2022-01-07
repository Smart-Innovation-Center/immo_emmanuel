<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Valery Maslov
 * Date: 24.08.2018
 * Time: 10:07.
 */

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UserProprietaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom de l\'utilisateur',
            ])
            ->add('email', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Email de l\'utilisateur',
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Mot de passe l\'utilisateur',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
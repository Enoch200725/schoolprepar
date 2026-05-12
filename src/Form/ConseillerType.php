<?php

namespace App\Form;

use App\Entity\Conseiller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class ConseillerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du conseiller',
                'attr' => [
                    'placeholder' => 'Ex: Agbeko',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est obligatoire']),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Âge',
                'attr' => [
                    'placeholder' => 'Ex: 35',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'L\'âge est obligatoire']),
                    new Range([
                        'min' => 18,
                        'max' => 70,
                        'notInRangeMessage' => 'L\'âge doit être compris entre {{ min }} et {{ max }} ans',
                    ]),
                ],
            ])
            ->add('role', ChoiceType::class, [
                'label' => 'Rôle du conseiller',
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'Conseiller Principal' => 'Conseiller Principal',
                    'Conseiller Orientation' => 'Conseiller Orientation',
                    'Conseiller Académique' => 'Conseiller Académique',
                    'Conseiller Pédagogique' => 'Conseiller Pédagogique',
                    'Conseiller Carrière' => 'Conseiller Carrière',
                ],
                'placeholder' => '-- Sélectionner un rôle --',
                'constraints' => [
                    new NotBlank(['message' => 'Le rôle est obligatoire']),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conseiller::class,
        ]);
    }
}
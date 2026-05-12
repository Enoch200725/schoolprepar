<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Etablissement;
use App\Entity\Conseiller;
use App\Entity\Enseignant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Ex: Kofi',
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
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Ex: Amma',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le prénom est obligatoire']),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Âge',
                'attr' => [
                    'placeholder' => 'Ex: 20',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'L\'âge est obligatoire']),
                    new Range([
                        'min' => 15,
                        'max' => 60,
                        'notInRangeMessage' => 'L\'âge doit être compris entre {{ min }} et {{ max }} ans',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => [
                    'placeholder' => 'Ex: amma.kofi@email.com',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'L\'email est obligatoire']),
                    new Email(['message' => 'L\'adresse email {{ value }} n\'est pas valide']),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Ex: Lomé, Togo',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'L\'adresse est obligatoire']),
                ],
            ])
            ->add('filiere', EntityType::class, [
                'label' => 'Filière',
                'class' => Filiere::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Sélectionner une filière --',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'La filière est obligatoire']),
                ],
            ])
            ->add('etablissement', EntityType::class, [
                'label' => 'Établissement',
                'class' => Etablissement::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Sélectionner un établissement --',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'L\'établissement est obligatoire']),
                ],
            ])
            ->add('conseiller', EntityType::class, [
                'label' => 'Conseiller',
                'class' => Conseiller::class,
                'choice_label' => 'nom',
                'placeholder' => '-- Sélectionner un conseiller --',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Le conseiller est obligatoire']),
                ],
            ])
            ->add('enseignants', EntityType::class, [
                'label' => 'Enseignants',
                'class' => Enseignant::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'form-control'],
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
            'data_class' => Etudiant::class,
        ]);
    }
}
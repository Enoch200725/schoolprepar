<?php

namespace App\Form;

use App\Entity\Conseiller;
use App\Entity\Enseignant;
use App\Entity\Etablissement;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('email')
            ->add('adresse')
            ->add('filiere', EntityType::class, [
                'class' => Filiere::class,
                'choice_label' => 'id',
            ])
            ->add('etablissement', EntityType::class, [
                'class' => Etablissement::class,
                'choice_label' => 'id',
            ])
            ->add('conseiller', EntityType::class, [
                'class' => Conseiller::class,
                'choice_label' => 'id',
            ])
            ->add('enseignants', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'required' => false,
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

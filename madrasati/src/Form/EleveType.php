<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Niveau;
use App\Entity\Parents;
use App\Entity\Services;
use App\Entity\AnneeScolaire;
use DateTimeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $annee = new AnneeScolaire();
        $annee->getAnnee();
        // DateTimeInterface::format();
        $builder
            ->add('fullname')
            ->add('dateNaissance')
            ->add('cne')
            ->add('sexe')
            ->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5024k',
                    ])
                ]
            ])
            ->add('parent', EntityType::class, [
                'required' =>true,
                'label' =>'Choisir un parent',
                'class' => Parents::class,
                'choice_label' =>'fullname',
                'placeholder' => '-- Veuillez choisir un parent --',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un parent'
                    ])
                ]
            ])
            ->add('niveau', EntityType::class, [
                'required' =>true,
                'label' =>'Choisir un niveau',
                'class' => Niveau::class,
                'choice_label' =>'niveau',
                'placeholder' => '-- Veuillez choisir un niveau --',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un niveau'
                    ])
                ]
            ])
            ->add('annee_scolaire', EntityType::class, [
                'required' =>true,
                'label' =>'Choisir une année scolaire',
                'class' => AnneeScolaire::class,
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('a')
                    ->andWhere('a.annee = :annee')
                    ->setParameter('annee', date("Y"));
                },
                'choice_label' =>'annee',
                'placeholder' => '-- Veuillez choisir une année scolaire --',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une année scolaire'
                    ])
                ]
            ])
            ->add('service', EntityType::class, [
                'label' =>'Choisir un service',
                'class' => Services::class, 
                'query_builder' => function (EntityRepository $repo) {
                    $query = $repo->createQueryBuilder('s');
                    return $query;
                },
                'choice_label' =>'name',
                'multiple' => true,
                'expanded' => false,
                'placeholder' =>'--Choisir un service--',
                'mapped' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}

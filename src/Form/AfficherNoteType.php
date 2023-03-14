<?php

namespace App\Form;

use App\Entity\NoteDeFrais;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AfficherNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userCreeNoteDeFrais', EntityType::class, [
                'label' => 'Salarié: ',
                'class' => User::class, 'choice_label' => 'email', 'mapped' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dateCreation', DateTimeType::class, [
                'label' => 'Date et heure de la création: ',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('dateEvenement', DateType::class, [
                'label' => 'Date d\'évenement:',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('motif', TextareaType::class, [
                'label' => 'Motif: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('peageParking', NumberType::class, [
                'label' => 'Péage(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('transportsPublics', NumberType::class, [
                'label' => 'Transports en commun(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('carburant', NumberType::class, [
                'label' => 'Carburant(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('restoDejeuner', NumberType::class, [
                'label' => 'Resto - Déjeuner(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('restoDiner', NumberType::class, [
                'label' => 'Resto - Dîner(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('hebergement', NumberType::class, [
                'label' => 'Hebergement(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('kmParcourus', NumberType::class, [
                'label' => 'Kms Parcourus: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('indemnites', NumberType::class, [
                'label' => 'Indemnites(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('divers', NumberType::class, [
                'label' => 'Divers(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('infoNote', TextareaType::class, [
                'label' => 'Infos: ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('totaux', NumberType::class, [
                'label' => 'TOTAUX(€): ',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NoteDeFrais::class,
        ]);
    }
}

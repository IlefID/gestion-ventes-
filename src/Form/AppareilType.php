<?php

namespace App\Form;

use App\Entity\Appareil;
use App\Entity\Fabricant;
use App\Entity\Systeme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AppareilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', IntegerType::class, [
                'label' => 'Code:',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('designation', TextType::class, [
                'label' => 'Designation:',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('type', TextType::class, [
                'label' => 'Type:',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('prixUnit', NumberType::class, [
                'label' => 'PrixUnit:',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('qteVendue', NumberType::class, [
                'label' => 'QuantiteVendue:',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('dateSortie', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'label' => 'DateSortie',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
              ))
              ->add('idos', EntityType::class, [
                'class' => Systeme::class,
                'choice_label' => 'famille',
                'label' => 'Famille:',
                'attr' => [
                    'class' => 'form-control', // Add 'form-control' class
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])            
            ->add('idfab', EntityType::class, [
                'class' => Fabricant::class,
                'choice_label' => 'nom',
                'label' => 'Nom:',
                'attr' => [
                    'class' => 'form-control', // Add 'form-control' class
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('imageUrl', TextType::class, [
                'label' => 'Image URL:', 
                'required' => false, 
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appareil::class,
        ]);
    }
}

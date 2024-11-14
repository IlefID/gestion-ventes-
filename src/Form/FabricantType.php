<?php

namespace App\Form;

use App\Entity\Fabricant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FabricantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idfab', IntegerType::class, [
                'label' => 'ID Fab:',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom:',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('paysOrigine',TextType::class, [
                'label' => 'PaysOrigine:',
                'attr' => [
                    'class' => 'form-control',
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
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fabricant::class,
        ]);
    }
}

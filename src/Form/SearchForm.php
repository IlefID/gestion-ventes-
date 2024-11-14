<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Data\SearchData;
use App\Entity\Appareil;
use App\Form\AppareilType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('types', EntityType::class,[
                'label' => false,
                'required'=> false,
                'class' => Appareil::class,
                'expanded' => true,
                'multiple' => true
            ])
        
            ->add('max', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'prix max',
                ]
            ])
            ->add('min', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'prix min',
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> SearchData::class,
            'method'=>'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return "";
    }
}

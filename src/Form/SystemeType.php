<?php

namespace App\Form;

use App\Entity\Systeme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SystemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    ->add('idos', IntegerType::class, [
        'label' => 'ID OS:',
        'attr' => [
            'class' => 'form-control',
        ],
        'label_attr' => [
            'class' => 'form-label',
        ],
    ])
    ->add('famille', TextType::class, [
        'label' => 'Famille:',
        'attr' => [
            'class' => 'form-control',
        ],
        'label_attr' => [
            'class' => 'form-label',
        ],
    ])
    ->add('editeur', TextType::class, [
        'label' => 'Editeur:',
        'attr' => [
            'class' => 'form-control',
        ],
        'label_attr' => [
            'class' => 'form-label',
        ],
    ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Systeme::class,
        ]);
    }
}

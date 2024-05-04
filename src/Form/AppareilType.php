<?php

namespace App\Form;

use App\Entity\Appareil;
use App\Entity\Fabricant;
use App\Entity\Systeme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppareilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('designation')
            ->add('type')
            ->add('prixUnit')
            ->add('qteVendue')
            ->add('dateSortie', null, [
                'widget' => 'single_text',
            ])
            ->add('idos', EntityType::class, [
                'class' => Systeme::class,
                'choice_label' => 'id',
            ])
            ->add('idfab', EntityType::class, [
                'class' => Fabricant::class,
                'choice_label' => 'id',
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

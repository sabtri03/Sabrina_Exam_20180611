<?php

namespace App\Form;

use App\Entity\Acteurs;
use App\Entity\Films;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActeursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_de_naissance', DateType::class)
            ->add('date_de_deces', DateType::class)
            ->add('image_url')
            ->add('films',
                EntityType::class,
                [
                    'class' => Films::class,
                    'choice_label' => 'title',
                    'expanded'     => true,
                    'multiple'     => true,
                    'by_reference' => false,
                ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Acteurs::class,
        ]);
    }
}

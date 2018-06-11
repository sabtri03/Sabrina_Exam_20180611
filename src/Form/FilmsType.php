<?php

namespace App\Form;

use App\Entity\Acteurs;
use App\Entity\Affiches;
use App\Entity\Films;
use App\Entity\Genres;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('resume',TextareaType::class)
            ->add('date_sortie',DateType::class )
            ->add('production')
            ->add('realisateur')
            ->add('genres', EntityType::class, ['class'=>Genres::class,'choice_label'=>'nom'])
            ->add('affiches', EntityType::class, ['class'=>Affiches::class,'choice_label'=>'description'])
            ->add('acteurs',
                EntityType::class,
                [
                    'class' => Acteurs::class,
                    'choice_label' => 'nom',
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
            'data_class' => Films::class,
        ]);
    }
}

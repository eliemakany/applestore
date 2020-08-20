<?php

namespace App\Form;

use App\Entity\AppleSearch;
use App\Entity\Category;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'label'=>false,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez vos tags',
                'multiple' => true,
                'attr'=>['class'=>'tag', 'placeholder'=>'Sélectionnez vos tags']
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label'=>false,
                'choice_label' => 'name',
                'placeholder' => 'Choisir une catégorie'
            ])
            ->add('origin', CountryType::class, [
                'placeholder' => 'Choisir un pays',
                'label'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppleSearch::class,
            'method' =>'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}

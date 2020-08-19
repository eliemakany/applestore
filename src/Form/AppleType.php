<?php

namespace App\Form;

use App\Entity\Apple;
use App\Entity\Category;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AppleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image (.jpg ou .png)',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
                'imagine_pattern' => 'squared_thumbnail_small',
            ])
            ->add('name')
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'editor'],
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner vos tags',
                'multiple' => true
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisir une catégorie'
            ])
            ->add('origin', CountryType::class, [
                'placeholder' => 'Choisir un pays'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apple::class,
        ]);
    }
}

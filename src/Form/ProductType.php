<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre',
                'required' => true
            ])
            ->add('description', null, [
                'required' => true
            ])
            ->add('detail', null, [
                'label' => 'Détail',
                'required' => true
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image du produit',
                'required' => true
            ])
            ->add('price', null, [
                'label' => 'Prix du produit',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

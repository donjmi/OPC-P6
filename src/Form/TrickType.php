<?php

namespace App\Form;

use App\Entity\Trick;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            // ->add('created_at')
            // ->add('updated_at')
            ->add('users')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function($category){
                    return ($category->getId().' - '.$category->getName());
                }
            ])
            ->add('mainImgFile', FileType::class, [
                'required' => false
            ])
            ->add('pictureFiles', FileType::class, [
                'required' => false,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;


class CategorySelectedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'required' => false,
            ])
            ->add('rechercher', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}

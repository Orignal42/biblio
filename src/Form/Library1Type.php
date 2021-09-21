<?php

namespace App\Form;

use App\Entity\Library;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Library1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('author')
            ->add('editor')
            ->add('price')
            ->add('event')
            ->add('protected')
            ->add('public')
            ->add('book')
            ->add('cover')
            ->add('created_at')
            ->add('updated_at')
            ->add('abstract')
            ->add('serie')
            ->add('category')
            ->add('comments')
            ->add('competition')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Library::class,
        ]);
    }
}

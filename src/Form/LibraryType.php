<?php

namespace App\Form;

use App\Entity\Library;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class LibraryType extends AbstractType
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
             ->add('cover'
            , FileType::class,[
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '20000000k',
                        'mimeTypes' => [
                            'image/png',
                            'application/x-pdf',
                            'application/pdf',
                            'image/jpg',
                               'image/jpeg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid document',
                        ])
                    ],
                ]
            )
            ->add('created_at',DateType::class)
            ->add('updated_at',DateType::class)
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

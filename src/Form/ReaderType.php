<?php

namespace App\Form;

use App\Entity\Reader;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\RegistrationFormType;



class ReaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('newsletter', ChoiceType::class, [
                'choices'  => [                    
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reader::class,
        ]);
    }
}

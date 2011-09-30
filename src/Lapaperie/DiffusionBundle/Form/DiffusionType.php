<?php

namespace Lapaperie\DiffusionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DiffusionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('video', 'textarea',array('required' => false))
            ->add('contenu','textarea',array('required' => false))
            ->add('isPreviousYear', 'checkbox',array('required' => false))
            ->add('year')
            ->add('image')
            ->add('file')
            ->add('link', 'text',array('required' => false))
        ;
    }

    public function getName()
    {
        return 'lapaperie_diffusionbundle_diffusiontype';
    }
}

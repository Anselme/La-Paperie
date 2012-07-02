<?php

namespace Lapaperie\RessourcesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RessourcesType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('video', 'textarea',array('required' => false))
            ->add('contenu','textarea',array('required' => false))
            ->add('isPreviousYear', 'checkbox',array('required' => false))
            ->add('year')
        ;
    }

    public function getName()
    {
        return 'lapaperie_ressourcesbundle_ressourcestype';
    }
}

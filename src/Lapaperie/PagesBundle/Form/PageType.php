<?php

namespace Lapaperie\PagesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('contenu','textarea',array('required' => false))
            ->add('video','textarea',array('required' => false))
            ->add('image')
            ->add('file')
            ->add('link')
        ;
    }

    public function getName()
    {
        return 'lapaperie_pagesbundle_pagetype';
    }
}

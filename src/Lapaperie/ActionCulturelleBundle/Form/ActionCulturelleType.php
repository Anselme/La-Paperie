<?php

namespace Lapaperie\ActionCulturelleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ActionCulturelleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('video', 'textarea',array('required' => false))
            ->add('contenu','textarea',array('required' => true))
            ->add('year')
            ->add('image')
        ;
    }

    public function getName()
    {
        return 'lapaperie_actionculturellebundle_actionculturelletype';
    }
}

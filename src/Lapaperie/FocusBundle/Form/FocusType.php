<?php

namespace Lapaperie\FocusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FocusType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('text','textarea',array('required' => false))
            ->add('isOnLine', 'checkbox',array('required' => false))
            ->add('publicationDate','date')
            ->add('video','textarea')
            ->add('legend','text')
        ;
    }

    public function getName()
    {
        return 'lapaperie_focusbundle_focustype';
    }
}

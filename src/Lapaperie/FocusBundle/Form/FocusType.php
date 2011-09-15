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
            ->add('publicationDate','date', array('input' => 'datetime', 'widget' => 'single_text','format' => \IntlDateFormatter::SHORT))
            //->add('publicationDate','date', array('input' => 'string', 'widget' => 'single_text', 'format' => 'yy-mm-dd'))
            ->add('video','textarea',array('required' => false))
            ->add('legend','text',array('required' => false))
        ;
    }

    public function getName()
    {
        return 'lapaperie_focusbundle_focustype';
    }
}

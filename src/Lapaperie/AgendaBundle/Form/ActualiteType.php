<?php

namespace Lapaperie\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ActualiteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $dateArgsArray = array('required' => false,
            'input' => 'datetime',
            'widget' => 'single_text',
            'format' => \IntlDateFormatter::SHORT);

        $builder
            ->add('date_beginning','date', $dateArgsArray)
            ->add('date_end','date', $dateArgsArray)
            ->add('actualite','textarea',array('required' => false))
            ->add('isOnHome', 'checkbox',array('required' => false))
            ;
    }

    public function getName()
    {
        return 'lapaperie_agendabundle_actualitetype';
    }
}

<?php

namespace Lapaperie\VideoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('embded')
            ->add('publicationDate','date', array('input' => 'datetime', 'widget' => 'single_text','format' => \IntlDateFormatter::SHORT))
            ->add('isOnLine', 'checkbox',array('required' => false))
            ->add('legend','text',array('required' => false))
            //->add('companie','choice',array('required' => false, 'empty_value' => 'Choisir une Companie (ou pas))
            //->add('companie','choice',array('required' => false))
            //->add('companie','choice')
            ->add('companie')
        ;
    }

    public function getName()
    {
        return 'lapaperie_videobundle_videotype';
    }
}

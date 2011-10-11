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
            ->add('companie','entity',array('class' => 'LapaperieCompaniesBundle:Companie',
                                            'required' => false,
                                             'empty_value' => 'Choisir une Companie (ou pas)'))
            ->add('imageThumb')
        ;
    }

    public function getName()
    {
        return 'lapaperie_videobundle_videotype';
    }
}

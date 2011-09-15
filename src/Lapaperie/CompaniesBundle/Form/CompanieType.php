<?php

namespace Lapaperie\CompaniesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CompanieType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('creation')
            ->add('date_residence_beginning','date', array('widget' => 'single_text'))
            ->add('date_residence_end','date', array('widget' => 'single_text'))
            ->add('date_sortie_de_fabrique','date', array('widget' => 'single_text'))
            ->add('short_text','textarea',array('required' => false))
            ->add('long_text','textarea',array('required' => false))
        ;
    }

    public function getName()
    {
        return 'lapaperie_companiesbundle_companietype';
    }
}

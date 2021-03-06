<?php

namespace Lapaperie\CompaniesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CompanieType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $dateArgsArray = array('required' => false,
            'input' => 'datetime',
            'widget' => 'single_text',
            'format' => 'MM/dd/yyyy',
        );

        $builder
            ->add('name')
            ->add('creation')
            ->add('date_residence_beginning','date', $dateArgsArray)
            ->add('date_residence_end','date', $dateArgsArray)
            ->add('date_sortie_de_fabrique','date', $dateArgsArray)
            ->add('short_text','textarea',array('required' => false))
            ->add('long_text','textarea',array('required' => false))
            ->add('isPreviousYear', 'checkbox',array('required' => false))
            ->add('year')
            ;
    }

    public function getName()
    {
        return 'lapaperie_companiesbundle_companietype';
    }
}

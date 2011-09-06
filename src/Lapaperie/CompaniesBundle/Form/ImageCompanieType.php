<?php

namespace Lapaperie\CompaniesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageCompanieType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('image')
        ;
    }

    public function getName()
    {
        return 'lapaperie_companiesbundle_imagecompanietype';
    }
}

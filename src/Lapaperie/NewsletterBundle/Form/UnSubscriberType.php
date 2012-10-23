<?php

namespace Lapaperie\NewsletterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UnSubscriberType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder
            ->add('email','email')
            ;
    }

    public function getName()
    {
        return 'lapaperie_subscriberbundle_unsubscribertype';
    }
}

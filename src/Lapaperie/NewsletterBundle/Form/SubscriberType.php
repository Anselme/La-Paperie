<?php

namespace Lapaperie\NewsletterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SubscriberType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder
            ->add('email','email')
            ->add('firstname',null,array('required' => false))
            ->add('lastname',null,array('required' => false))
            ;
    }

    public function getName()
    {
        return 'lapaperie_subscriberbundle_subscribertype';
    }
}

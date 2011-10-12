<?php

namespace Lapaperie\FileUploadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FileUploadType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('link')
        ;
    }

    public function getName()
    {
        return 'lapaperie_fileuploadbundle_fileuploadtype';
    }
}

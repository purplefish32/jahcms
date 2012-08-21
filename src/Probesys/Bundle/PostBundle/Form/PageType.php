<?php

namespace Probesys\Bundle\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractPostType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options );

        $builder
            ->add('post_type', 'hidden', array(
                    'data' => 'page',
                )
            )
            ->add('post_parent', 'entity', array(
                'class'    => 'Probesys\Bundle\PostBundle\Entity\Post',
                'required' => false
            ))
            ->add('post_content', 'textarea', array(
                    "property_path" => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'simple' // simple, advanced, bbcode
                    )
                )
            )
        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Probesys\Bundle\PostBundle\Entity\Post'
            )
        );
    }

    public function getName()
    {
        return 'probesys_bundle_postbundle_pagetype';
    }
}

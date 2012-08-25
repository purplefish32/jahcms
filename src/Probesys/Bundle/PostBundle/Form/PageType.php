<?php

namespace Probesys\Bundle\PostBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class PageType extends AbstractPostType
{
    private $post;

    public function __construct(\Probesys\Bundle\PostBundle\Entity\Post $post = null)
    {
        $post->postContent = "";

        $postMetas = $post->getPostMetas();

        if($postMetas) {
            foreach($postMetas as $postMeta) {
                if($postMeta->getMetaKey() == 'postContent') {
                    $post->postContent = $postMeta->getMetaValue();
                }
            }
        }

        $this->post = $post;
    }

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
            ->add('postContent', 'textarea', array(
                    'property_path' => false,
                    'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'simple', // simple, advanced, bbcode
                    ),
                    'data' => $this->post->postContent//TODO
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

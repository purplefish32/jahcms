<?php

namespace Probesys\Bundle\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AbstractPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('post_title', 'text', array(
                    'label' => 'post.title',
                )
            )
            ->add('post_date', 'datetime')
            ->add('post_status', 'choice', array(
                'choices' => array(
                    'draft',
                    'pending'
                ),
                'data' => 'publish'
            ))
            ->add('post_mime_type', 'hidden')
        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Probesys\Bundle\PostBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'probesys_bundle_postbundle_abstractposttype';
    }
}

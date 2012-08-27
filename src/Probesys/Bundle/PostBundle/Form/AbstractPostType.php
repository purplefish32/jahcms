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
            ->add('postTitle', 'text', array(
                    'label' => 'post.title',
                )
            )
            ->add('postDate', 'datetime')
            ->add('postStatus', 'choice', array(
                'choices' => array(
                    'draft',
                    'pending'
                ),
                'data' => 'publish'
            ))
            ->add('postMimeType', 'hidden')
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

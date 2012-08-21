<?php

namespace Probesys\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slogan')
            ->add('wordpressUrl')
            ->add('siteUrl')
            ->add('adminEmail')
            ->add('dateFormat')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Probesys\Bundle\CmsBundle\Entity\Setting'
        ));
    }

    public function getName()
    {
        return 'probesys_bundle_cmsbundle_settinggeneraltype';
    }
}

<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2012 Donovan Tengblad <contact@donovan-tengblad.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category   Form
 * @package    JahCMS
 * @author     Donovan Tengblad <contact@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
namespace Probesys\Bundle\PostBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * PostType
 */
class PostType extends AbstractPostType
{
    /**
     * Post
     *
     * @var post
     */
    private $post;

    /**
     * Post Content
     *
     * @var postContent
     */
    private $postContent;

    /**
     * Constructor
     *
     * @param \Probesys\Bundle\PostBundle\Entity\Post $post Post
     */
    public function __construct(\Probesys\Bundle\PostBundle\Entity\Post $post = null)
    {
        if ($post) {
            $postMetas = $post->getPostMetas();

            if ($postMetas) {
                foreach ($postMetas as $postMeta) {
                    if ($postMeta->getMetaKey() == 'postContent') {
                        $this->postContent = $postMeta->getMetaValue();
                    }
                }
            }
        }
    }

    /**
     * Form builder
     *
     * @param FormBuilderInterface $builder Builder
     * @param array                $options Options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add(
                'postType',
                'hidden',
                array(
                    'data' => 'post',
                )
            )
            ->add('postContent', 'textarea', array(
                    "property_path" => false,
                    'attr' => array(
                        'class' => 'markItUp'
                    ),
                    'data' => $this->postContent
                )
            )
        ;

    }

    /**
     * Set Default Options
     *
     * @param OptionsResolverInterface $resolver Resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Probesys\Bundle\PostBundle\Entity\Post'
        ));
    }

    /**
     * Get Name
     *
     * @return string Name
     */
    public function getName()
    {
        return 'probesys_bundle_postbundle_posttype';
    }
}

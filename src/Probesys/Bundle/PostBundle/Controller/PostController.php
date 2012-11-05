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
 * @category   Controller
 * @package    JahCMS
 * @subpackage PostBundle
 * @author     Donovan Tengblad <contact@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
namespace Probesys\Bundle\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Probesys\Bundle\PostBundle\Entity\Post;
use Probesys\Bundle\PostBundle\Form\PostType;

/**
 * Post controller.
 *
 * @category   Controller
 * @package    JahCMS
 * @subpackage PostBundle
 * @author     Donovan Tengblad <contact@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 *
 * @Route()
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @return array Response
     *
     * @Route("/admin/posts/", name="admin_post")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ProbesysPostBundle:Post')->findByPostType('post');

        return compact(
            'posts'
        );
    }

    /**
     * Lists all posts in trash.
     *
     * @return array Response
     *
     * @Route("/admin/post/trash/", name="admin_post_trash")
     * @Template()
     */
    public function trashAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ProbesysPostBundle:Post')->findByPostTypeAndByPostStatus('page', 'trash');

        return compact(
            'posts'
        );
    }

    /**
     * Finds and displays a Post entity.
     *
     * @param int $postId Post ID
     *
     * @return array Response
     *
     * @Route("/{postId}/show", name="post_show")
     * @Template("ProbesysPostBundle:Post:show.html.twig")
     */
    public function showAction($postId)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($postId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        if (!$post->getPostStatus() == 'publish') {
            die("This post is not published");
        }

        foreach ($post->getPostMetas() as $meta) {
            $post->{$meta->getMetaKey()} = $meta->getMetaValue();
        }

        return array(
            'post' => $post,
        );
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @return array Response
     *
     * @Route("/admin/post/new", name="admin_post_new")
     * @Template("ProbesysPostBundle:Post:new.html.twig")
     */
    public function newAction()
    {
        $post = new Post();

        $post
            ->setPostType('post');

        $form = $this->createForm(new PostType(), $post);

        return array(
            'post'      => $post,
            'edit_form' => $form->createView(),
        );
    }

      /**
     * Creates a new Crew entity.
     *
     * @return array Response
     *
     * @Route("/admin/post/create", name="admin_post_create")
     * @Method("post")
     * @Template("ProbesysPostBundle:Post:new.html.twig")
     */
    public function createAction()
    {
        $post    = new Post();
        $request = $this->getRequest();
        $form    = $this->createForm(new PostType(), $post);
        $form->bindRequest($request);

        if ($form->isValid()) {

            $now = new \Datetime();

            $post->setPostModified($now);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($post);
            $em->flush();

            $this->get('session')->setFlash('success', "Post created");

            return $this->redirect($this->generateUrl('admin_post'));

        }

        $this->get('session')->setFlash('error', "Post not created");

        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @param int $postId Post ID
     *
     * @return array Response
     *
     * @Route("/admin/post/{postId}/edit", name="admin_post_edit")
     * @Template()
     */
    public function editAction($postId)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($postId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        $editForm = $this->createForm(
            new PostType($post),
            $post
        );

        return array(
            'post'      => $post,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing Post entity.
     *
     * @param int $postId Post ID
     *
     * @return array Response
     *
     * @Route("/admin/post/{postId}/update", name="admin_post_update")
     * @Method("post")
     * @Template("ProbesysPostBundle:Post:edit.html.twig")
     */
    public function updateAction($postId)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $post = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->find($postId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post post.');
        }

        $editForm = $this->createForm(
            new PostType($post),
            $post
        );

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            $postData = $request
                ->request
                ->all();

            if (isset($postData['action'])) {
                $post->setPostStatus($postData['action']);
            }

            if (isset($postData['postAuthor'])) {
                $post->postAuthor = $postData['postAuthor'];
            }

            if ($postData['probesys_bundle_postbundle_posttype']['postContent']) {
                $em
                    ->getRepository('ProbesysPostBundle:PostMeta')
                    ->findOneByPostIdAndByMetaKey($postId, 'postContent');

                $postContent = $em;
            }

            $postContent
                ->setPost($post)
                ->setMetaKey('postContent')
                ->setMetaValue($postData['postContent']);

            $post->addPostMeta($postContent);

            $em->persist($post);
            $em->flush();

            $this->get('session')->setFlash('success', 'post.flash.update.success');

            return $this->redirect(
                $this->generateUrl(
                    'admin_post',
                    array(
                        'id' => $postId
                    )
                )
            );
        }

        return array(
            'post'      => $post,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Post entity.
     *
     * @param int $postId Post ID
     *
     * @return array Response
     *
     * @Route("/admin/post/{postId}/delete", name="admin_post_delete")
     */
    public function deleteAction($postId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProbesysPostBundle:Post')->find($postId);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->setFlash('success', 'post.flash.delete.success');

        return $this->redirect(
            $this->generateUrl('admin_post')
        );
    }
}

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
use Probesys\Bundle\PostBundle\Entity\PostMeta;
use Probesys\Bundle\PostBundle\Form\PageType;

/**
 * Page controller.
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
class PageController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @return array Response
     *
     * @Route("/admin/pages/", name="admin_page")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $posts = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->findByPostType('page');

        return compact(
            'posts'
        );
    }

    /**
     * Lists all pages in trash.
     *
     * @return array Response
     *
     * @Route("/admin/page/trash/", name="admin_page_trash")
     * @Template()
     */
    public function trashAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $posts = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->findByPostTypeAndByPostStatus('page', 'trash');

        return compact(
            'posts'
        );

    }

    /**
     * Finds and displays a Post entity.
     *
     * @param int $pageId Page ID
     *
     * @return array Response
     *
     * @Route("/{pageId}/show", name="page_show")
     * @Template("ProbesysPostBundle:Page:show.html.twig")
     */
    public function showAction($pageId)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $post = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->find($pageId);

        if ($post->getPostStatus() != 'publish') {
            die("This post is not published");
        }

        foreach ($post->getPostMetas() as $meta) {
            $post->{$meta->getMetaKey()} = $meta->getMetaValue();
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
     * @Route("/admin/page/new", name="admin_page_new")
     * @Template("ProbesysPostBundle:Page:edit.html.twig")
     */
    public function newAction()
    {
        $now = new \Datetime();

        $post = new Post();

        $post
            ->setpostTitle('auto-draft')
            ->setPostDate($now)
            ->setpostStatus('auto-draft')
            ->setPostModified($now)
            ->setPostType('page');

        $em = $this
            ->getDoctrine()
            ->getManager();

        $em->persist($post);
        $em->flush();

        $post
            ->setpostTitle('');

        $editForm = $this->createForm(
            new PageType($post), $post
        );

        return array(
            'post'      => $post,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @param int $pageId Page ID
     *
     * @return array Response
     *
     * @Route("/admin/page/{pageId}/edit", name="admin_page_edit")
     * @Template()
     */
    public function editAction($pageId)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $post = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->find($pageId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        $editForm = $this->createForm(
            new PageType($post),
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
     * @param int $pageId Page ID
     *
     * @return array Response
     *
     * @Route("/admin/page/{pageId}/update", name="admin_page_update")
     * @Method("post")
     * @Template("ProbesysPostBundle:Post:edit.html.twig")
     */
    public function updateAction($pageId)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $post = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->find($pageId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        $editForm = $this->createForm(
            new PageType($post),
            $post
        );

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            // $postData = $request
            //     ->request
            //     ->get('probesys_bundle_postbundle_pagetype');
            $postData = $request
                ->request
                ->all();

            if ($request->get('action') == 'publish') {
                die ("here");
            }

            var_dump($postData);
            die( "not here" );

            $postContent = $em
                ->getRepository('ProbesysPostBundle:PostMeta')
                ->findOneByPost($pageId);

            if (!$postContent) {
                $postContent = new PostMeta();
            }

            $postContent
                ->setPost($post)
                ->setMetaKey('postContent')
                ->setMetaValue($postData['postContent']);

            if ($request->get('action')) {
                $post->setPostStatus(
                    $request->get('action')
                );
            }

            $post->addPostMeta($postContent);

            $em->persist($post);
            $em->flush();

            $this
                ->get('session')
                ->setFlash('success', 'page.flash.update.success');

            return $this->redirect(
                $this->generateUrl(
                    'admin_page'
                )
            );
        }

        return array(
            'post'      => $post,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Deletes a Post entity.
     *
     * @param int $pageId Page ID
     *
     * @return array Response
     *
     * @Route("/admin/page/{pageId}/delete", name="admin_page_delete")
     */
    public function deleteAction($pageId)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $post = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->find($pageId);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post post.');
        }

        $em->remove($post);
        $em->flush();

        $this
            ->get('session')
            ->setFlash('success', 'page.flash.delete.success');

        return $this->redirect(
            $this->generateUrl('admin_page')
        );
    }
}

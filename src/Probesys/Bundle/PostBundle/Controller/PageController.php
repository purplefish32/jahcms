<?php

namespace Probesys\Bundle\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Probesys\Bundle\PostBundle\Entity\Post;
use Probesys\Bundle\PostBundle\Entity\PostMeta;
use Probesys\Bundle\PostBundle\Form\PageType;

/**
 * Post controller.
 *
 * @Route()
 */
class PageController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @Route("/admin/page/", name="admin_page")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ProbesysPostBundle:Post')->findByPostType('page');

        return compact(
            'posts'
        );
    }

    /**
     * Lists all pages in trash.
     *
     * @Route("/admin/page/trash/", name="admin_page_trash")
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
     * @Route("/{id}/show", name="page_show")
     * @Template("ProbesysPostBundle:Page:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($id);

         if ($post->getPostStatus() != 'publish') {
            die("This post is not published");
        }

        foreach($post->getPostMetas() as $meta) {
            $post->{$meta->getMetaKey()} = $meta->getMetaValue();
        }

        foreach($post->getPostMetas() as $meta) {
            $post->{$meta->getMetaKey()} = $meta->getMetaValue();
        }

        return array(
            'post' => $post,
        );
    }

    /**
     * Displays a form to create a new Post entity.
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
            ->setPostType('post');

        $em = $this->getDoctrine()->getManager();

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
     * @Route("/admin/page/{id}/edit", name="admin_page_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($id);

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
     * @Route("/admin/page/{id}/update", name="admin_page_update")
     * @Method("post")
     * @Template("ProbesysPostBundle:Post:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($id);

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
            $postData = $request->request->get('probesys_bundle_postbundle_pagetype');

            $postContent = $em->getRepository('ProbesysPostBundle:PostMeta')->findOneByPost($id);

            if(!$postContent) {
                $postContent = new PostMeta();
            }

            $postContent
                ->setPost($post)
                ->setMetaKey('postContent')
                ->setMetaValue($postData['postContent']);

            if ($request->get('action')) {
                $post
                    ->setPostStatus(
                        $request->get('action')
                    );
            }

            $post->addPostMeta($postContent);

            $em->persist($post);
            $em->flush();

            $this->get('session')->setFlash('success', 'page.flash.update.success');

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
     * @Route("/admin/page/{id}/delete", name="admin_page_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post post.');
        }

        $em->remove($post);
        $em->flush();

        $this->get('session')->setFlash('success', 'page.flash.delete.success');

        return $this->redirect(
            $this->generateUrl('admin_page')
        );
    }
}

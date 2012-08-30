<?php

namespace Probesys\Bundle\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Probesys\Bundle\PostBundle\Entity\Post;
use Probesys\Bundle\PostBundle\Entity\PostMeta;
use Probesys\Bundle\PostBundle\Form\PostType;

/**
 * Post controller.
 *
 * @Route()
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @Route("/admin/post/", name="admin_post")
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
     * @Route("/{id}/show", name="post_show")
     * @Template("ProbesysPostBundle:Post:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        if (!$post->getPostStatus() == 'publish') {
            die("This post is not published");
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
     * @Route("/admin/post/new", name="admin_post_new")
     * @Template("ProbesysPostBundle:Post:edit.html.twig")
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
            new PostType($post), $post
        );

        return array(
            'post'      => $post,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/admin/post/{id}/edit", name="admin_post_edit")
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
     * @Route("/admin/post/{id}/update", name="admin_post_update")
     * @Method("post")
     * @Template("ProbesysPostBundle:Post:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('ProbesysPostBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post post.');
        }

        $editForm   = $this->createForm(
            new PostType($post),
            $post
        );

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $postData = $request->request->get('probesys_bundle_postbundle_posttype');

            $postContent = $em->getRepository('ProbesysPostBundle:PostMeta')->findOneByPost($id);

            if(!$postContent) {
                $postContent = new PostMeta();
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
                        'id' => $id
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
     * @Route("/admin/post/{id}/delete", name="admin_post_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProbesysPostBundle:Post')->find($id);

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

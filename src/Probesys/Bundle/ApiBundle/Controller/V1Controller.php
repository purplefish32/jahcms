<?php

namespace Probesys\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class V1Controller extends Controller
{
    /**
     * @Route("/api/v1/posts.json")
     * @Method("GET")
     */
    public function allPostsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ProbesysPostBundle:Post')->findByPostType('post');

        $serializer = $this->container->get('serializer');

        $posts = $serializer->serialize($posts, 'json');

        return new Response($posts, 200, array('Content-Type'=>'application/json', 'Access-Control-Allow-Origin' => '*'));
    }

    /**
     * @Route("/api/v1/posts.json/{id}")
     * @Method("GET")
     */
    public function getPostsAction($id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $post = $em
            ->getRepository('ProbesysPostBundle:Post')
            ->find($id);

        $serializer = $this->container->get('serializer');

        $posts = $serializer->serialize($post, 'json');

        return new Response($post, 200, array('Content-Type'=>'application/json', 'Access-Control-Allow-Origin' => '*'));
    }
}

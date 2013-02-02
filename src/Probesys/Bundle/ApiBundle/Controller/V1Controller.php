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
 * @subpackage ApiBundle
 * @author     Donovan Tengblad <contact@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
namespace Probesys\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Version 1
 */
class V1Controller extends Controller
{
    /**
     * All posts
     *
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
     * Get posts
     *
     * @param string $id ID
     *
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

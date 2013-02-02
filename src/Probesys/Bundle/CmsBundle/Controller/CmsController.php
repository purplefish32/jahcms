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
 * @subpackage CmsBundle
 * @author     Donovan Tengblad <contant@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
namespace Probesys\Bundle\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class CmsController
 *
 * @category   Controller
 * @package    JahCMS
 * @subpackage CmsBundle
 * @author     Donovan Tengblad <contant@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
class CmsController extends Controller
{
    /**
     * CMS Index
     *
     * @return array response
     *
     * @Route("/admin/", name="dashboard")
     * @Route("/admin/", name="admin_comment")
     * @Route("/admin/", name="admin_user")
     * @Route("/admin/", name="admin_tool")
     * @Template()
     */
    public function indexAction()
    {
        $response = new Response();
        $response->setPublic();
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);

        return array();
    }

    /**
     * CMS Home
     *
     * @return array response
     *
     * @Route("/", name="home")
     * @Template()
     */
    public function homeAction()
    {
        $response = new Response();
        $response->setPublic();
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);

        return array();
    }
}

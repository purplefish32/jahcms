<?php

namespace Probesys\Bundle\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CmsController extends Controller
{
    /**
     * @Route("/admin/", name="dashboard")
     * @Route("/", name="admin_comment")
     * @Route("/", name="admin_user")
     * @Route("/", name="admin_tool")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function homeAction()
    {
        return array();
    }
}

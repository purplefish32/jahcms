<?php
namespace Probesys\Bundle\SamiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

class ApiController extends Controller
{
    /**
     * Api documentation
     *
     * @return array Response
     *
     * @Route("/admin/api")
     * @Template()
     */
    public function indexAction()
    {
        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->exclude('Resources')
            ->exclude('Tests')
            ->in($dir = __DIR__.'/../../../');

        // generate documentation for all v2.0.* tags, the 2.0 branch, and the master one
        $versions = GitVersionCollection::create($dir)
            //->addFromTags('v2.0.*')
            //->add('2.0', '2.0 branch')
            ->add('develop', 'develop branch')
            ->add('master', 'master branch');

        return new Sami(
            $iterator,
            array(
                'theme'                => 'symfony',
                'versions'             => $versions,
                'title'                => 'Symfony2 API',
                'build_dir'            => __DIR__.'/../build/jahcms/%version%',
                'cache_dir'            => __DIR__.'/../cache/jahcms/%version%',
                'default_opened_level' => 2,
            )
        );

        return array();
    }
}

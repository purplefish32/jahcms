<?php
namespace Probesys\Bundle\CmsBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild(
            'Posts', array('route' => 'admin_post')
        );

        $menu->addChild(
            'Pages', array('route' => 'admin_page')
        );

        // $menu->addChild(
        //     'Posts', array(
        //         'route' => 'page_show',
        //         'routeParameters' => array('id' => 42)
        //     )
        // );
        // ... add more children
        return $menu;
    }
}

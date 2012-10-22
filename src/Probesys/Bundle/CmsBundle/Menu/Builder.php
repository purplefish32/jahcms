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
 * @category   Menu
 * @package    JahCMS
 * @subpackage CmsBundle
 * @author     Donovan Tengblad <contant@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
namespace Probesys\Bundle\CmsBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function adminMenu(FactoryInterface $factory, array $options)
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

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild(
            'Home', array('route' => 'admin_post')
        );

        $menu->addChild(
            'About', array('route' => 'admin_page')
        );

        $menu->addChild(
            'Contact', array('route' => 'admin_page')
        );

        return $menu;
    }
}

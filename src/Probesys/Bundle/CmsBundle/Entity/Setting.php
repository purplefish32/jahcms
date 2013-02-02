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
 * @category   Entity
 * @package    JahCMS
 * @subpackage CmsBundle
 * @author     Donovan Tengblad <contant@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
namespace Probesys\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Probesys\Bundle\CmsBundle\Entity\Setting
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Probesys\Bundle\CmsBundle\Entity\SettingRepository")
 */
class Setting
{
    /**
     * @var integer $id ID
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name Name
     *
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     * @var text $value Value
     *
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     * @var string $autoload Autoload
     *
     * @ORM\Column(name="autoload", type="string", length=20)
     */
    private $autoload;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param  string  $name
     * @return Setting
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param  text    $value
     * @return Setting
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return text
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set autoload
     *
     * @param  string  $autoload
     * @return Setting
     */
    public function setAutoload($autoload)
    {
        $this->autoload = $autoload;

        return $this;
    }

    /**
     * Get autoload
     *
     * @return string
     */
    public function getAutoload()
    {
        return $this->autoload;
    }
}

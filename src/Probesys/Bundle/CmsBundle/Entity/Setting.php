<?php

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
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     * @var text $value
     *
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     * @var string $autoload
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
     * @param string $name
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
     * @param text $value
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
     * @param string $autoload
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
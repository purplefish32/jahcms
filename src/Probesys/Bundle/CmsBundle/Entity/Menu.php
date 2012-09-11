<?php

namespace Entity;

use Knp\Component\Tree\MaterialzedPath\Node;
use Knp\Component\Tree\MaterialzedPath\NodeInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="menu")
* @ORM\Entity(repositoryClass="Entity\MenuItemRepository")
*/
class MenuItem implements NodeInterface
{
    const PATH_SEPARATOR = '/';

    // traits baby!
    // if your php version doesn't support traits, copy paste the methods of Knp\Component\Tree\MaterialzedPath\Node
    //use Node {

    //}

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @param Collection the children in the tree
     */
    private $children;

    /**
     * @param NodeInterface the parent in the tree
     */
    private $parent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sort;

    public function __construct()
    {
        $this->children = new ArrayCollection;
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}

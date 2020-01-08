<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
    * @ORM\Column(type="string", length=150)
    */
    private $name;


    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="category")
    */
    private $articles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }
    public function getArticles() : Collection
    {
        return $this->articles;
    }
    public function __toString() : string
    {
        if ($this->name == null){
            $this->name = "";
        }
        return  $this->name;
        
    }
}

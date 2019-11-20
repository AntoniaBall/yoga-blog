<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

     /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     */
    private $category;

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

       public function getdate()
    {
        return $this->date;
    }

    public function setDate(string $titre)
    {
        $this->date = $date;

        return $this;
    }

       public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu(text $contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }
    public function setCategory()
    {
        $this->category = $category;

        return $this;
    }
     public function getCategory() : ?Category
    {
        return $this;
    }
}

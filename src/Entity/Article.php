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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

       public function getdate(): ?date("d/m/y")
    {
        return $this->date;
    }

    public function setDate(string $titre): self
    {
        $this->date = $date;

        return $this;
    }

       public function getContenu(): ?text
    {
        return $this->contenu;
    }

    public function setContenu(text $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
    public function setCategory() : self
    {
        $this->category = $category;

        return $this;
    }
     public function getCategory() : ?Category
    {
        return $this;
    }
}

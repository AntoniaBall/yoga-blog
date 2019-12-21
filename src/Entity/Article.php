<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @Vich\Uploadable
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles", cascade={"persist"})
     */
    private $category;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $brochureFileName;

    /**
     * @ORM\Column(type="string", length=250, nullable = true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="article_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     * @var \Datetime
     */
    private $updatedAt;
    
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

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }
     public function getCategory()
    {
        return $this->category;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        // $imageFile n'est pas écouté par Doctrine, il faudra rajouter une varible date de MAJ
        // pour que vich detecte qu'une nouvelle image est uploadée et fonctionne
        if($image)
        {
            $this->updatedAt = new \Datetime("now");
        }
    }
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setBrochureFileName($brochureFileName)
    {
         $this->brochureFileName = $brochureFileName;

        return $this;
    }
    public function getBrochureFileName()
    {
        return $this->brochureFileName;
    }
}

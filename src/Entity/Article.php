<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\HttpFoundation\File\File;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ApiResource(
 *   normalizationContext= {"groups"={"read"}},
 *   denormalizationContext={"groups"={"write"}}
 *  )
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @Vich\Uploadable
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "write"})
     * @ApiFilter(SearchFilter::class, strategy="partial")
     * @param string $titre
     * @ApiProperty(
     *      attributes={
     *         "open_api_context"={
     *          "type" ="string",
     *          "example" = "voici un exemple"
     *}})
     */
    private $titre;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read", "write"})
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read", "write"})
     * @Assert\Length(max=50)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles", cascade={"persist"})
     * @Groups({"read", "write"})
     */
    private $category;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read", "write"})
     */
    private $brochureFileName;

    /**
     * @ORM\Column(type="string", length=250, nullable = true)
     * @Groups({"read", "write"})
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
     * @Groups({"read", "write"})
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

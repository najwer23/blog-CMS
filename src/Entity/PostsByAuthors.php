<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsByAuthorsRepository")
 */
class PostsByAuthors
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idAuthor;

    /**
     * @ORM\Column(type="integer")
     */
    private $idPost;

    public function getId()
    {
        return $this->id;
    }

    public function getIdAuthor(): ?int
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(int $idAuthor): self
    {
        $this->idAuthor = $idAuthor;

        return $this;
    }

    public function getIdPost(): ?int
    {
        return $this->idPost;
    }

    public function setIdPost(int $idPost): self
    {
        $this->idPost = $idPost;

        return $this;
    }
}

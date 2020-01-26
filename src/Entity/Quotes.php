<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuotesRepository")
 */
class Quotes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $quote;

    /**
     * @ORM\Column(type="integer")
     */
    private $authorQuote;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(string $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getAuthorQuote(): ?string
    {
        return $this->authorQuote;
    }

    public function setAuthorQuote(string $authorQuote): self
    {
        $this->authorQuote = $authorQuote;

        return $this;
    }
}

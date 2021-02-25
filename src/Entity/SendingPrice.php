<?php

namespace App\Entity;

use App\Repository\SendingPriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SendingPriceRepository::class)
 */
class SendingPrice
{
    const METHOD_POST = 1;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $methodSending;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMethodSending(): ?string
    {
        return $this->methodSending;
    }

    public function setMethodSending(string $methodSending): self
    {
        $this->methodSending = $methodSending;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }
}

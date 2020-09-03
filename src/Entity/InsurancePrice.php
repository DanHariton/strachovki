<?php

namespace App\Entity;

use App\Repository\InsurancePriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InsurancePriceRepository::class)
 */
class InsurancePrice
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $threeMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $fourMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $fiveMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $sixMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $sevenMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $eightMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $nineMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $tenMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $elevenMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $twoYears;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getThreeMonth(): ?int
    {
        return $this->threeMonth;
    }

    public function setThreeMonth(int $threeMonth): self
    {
        $this->threeMonth = $threeMonth;

        return $this;
    }

    public function getFourMonth(): ?int
    {
        return $this->fourMonth;
    }

    public function setFourMonth(int $fourMonth): self
    {
        $this->fourMonth = $fourMonth;

        return $this;
    }

    public function getFiveMonth(): ?int
    {
        return $this->fiveMonth;
    }

    public function setFiveMonth(int $fiveMonth): self
    {
        $this->fiveMonth = $fiveMonth;

        return $this;
    }

    public function getSixMonth(): ?int
    {
        return $this->sixMonth;
    }

    public function setSixMonth(int $sixMonth): self
    {
        $this->sixMonth = $sixMonth;

        return $this;
    }

    public function getSevenMonth(): ?int
    {
        return $this->sevenMonth;
    }

    public function setSevenMonth(int $sevenMonth): self
    {
        $this->sevenMonth = $sevenMonth;

        return $this;
    }

    public function getEightMonth(): ?int
    {
        return $this->eightMonth;
    }

    public function setEightMonth(int $eightMonth): self
    {
        $this->eightMonth = $eightMonth;

        return $this;
    }

    public function getNineMonth(): ?int
    {
        return $this->nineMonth;
    }

    public function setNineMonth(int $nineMonth): self
    {
        $this->nineMonth = $nineMonth;

        return $this;
    }

    public function getTenMonth(): ?int
    {
        return $this->tenMonth;
    }

    public function setTenMonth(int $tenMonth): self
    {
        $this->tenMonth = $tenMonth;

        return $this;
    }

    public function getElevenMonth(): ?int
    {
        return $this->elevenMonth;
    }

    public function setElevenMonth(int $elevenMonth): self
    {
        $this->elevenMonth = $elevenMonth;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getTwoYears(): ?int
    {
        return $this->twoYears;
    }

    public function setTwoYears(int $twoYears): self
    {
        $this->twoYears = $twoYears;

        return $this;
    }

    public function toArray()
    {
        return [
            'threeMonth' => $this->threeMonth,
            'fourMonth' => $this->fourMonth,
            'fiveMonth' => $this->fiveMonth,
            'sixMonth' => $this->sixMonth,
            'sevenMonth' => $this->sevenMonth,
            'eightMonth' => $this->eightMonth,
            'nineMonth' => $this->nineMonth,
            'tenMonth' => $this->tenMonth,
            'elevenMonth' => $this->elevenMonth,
            'year' => $this->year,
            'twoYears' => $this->twoYears
        ];
    }
}

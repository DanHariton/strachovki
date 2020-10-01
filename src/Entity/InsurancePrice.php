<?php

namespace App\Entity;

use App\Repository\InsurancePriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InsurancePriceRepository::class)
 */
class InsurancePrice
{
    const PRICE_URGENT_MAXIMA = 'maximaUrgent';
    const PRICE_URGENT_MAXIMA_MID = 'maximaUrgentMid';
    const PRICE_URGENT_MAXIMA_OLD = 'maximaUrgentOld';
    const PRICE_MAXIMA = 'maxima';
    const PRICE_MAXIMA_MEDIUM = 'maximaMedium';
    const PRICE_MAXIMA_YOUNG = 'maximaYoung';
    const PRICE_MAXIMA_OLD = 'maximaOld';
    const PRICE_UNIQA = 'uniqa';
    const PRICE_UNIQA_MEDIUM = 'uniqaMedium';
    const PRICE_UNIQA_CHILD = 'uniqaChild';
    const PRICE_UNIQA_YOUNG = 'uniqaYoung';
    const PRICE_UNIQA_OLD = 'uniqaOld';
    const PRICE_UNIQA_SENIOR = 'uniqaSenior';
    const PRICE_UNIQA_MID = 'uniqaMid';
    const PRICE_PVZP = 'pvzp';
    const PRICE_PVZP_MEDIUM = 'pvzpMedium';
    const PRICE_PVZP_CHILD = 'pvzpChild';
    const PRICE_PVZP_YOUNG = 'pvzpYoung';
    const PRICE_PVZP_OLD = 'pvzpOld';
    const PRICE_PVZP_SENIOR = 'pvzpSenior';
    const PRICE_PVZP_MID = 'pvzpMid';
    const PRICE_ERGO = 'ergo';
    const PRICE_ERGO_MEDIUM = 'ergoMedium';
    const PRICE_ERGO_YOUNG = 'ergoYoung';
    const PRICE_ERGO_OLD = 'ergoOld';

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $oneMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $twoMonth;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $thirteenMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fourteenMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fifteenMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sixteenMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $seventeenMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $eighteenMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nineteenMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $twentyMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $twentyOneMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $twentyTwoMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $twentyThreeMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
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

    public function getThirteenMonth(): ?int
    {
        return $this->thirteenMonth;
    }

    public function setThirteenMonth(?int $thirteenMonth): self
    {
        $this->thirteenMonth = $thirteenMonth;

        return $this;
    }

    public function getFourteenMonth(): ?int
    {
        return $this->fourteenMonth;
    }

    public function setFourteenMonth(?int $fourteenMonth): self
    {
        $this->fourteenMonth = $fourteenMonth;

        return $this;
    }

    public function getFifteenMonth(): ?int
    {
        return $this->fifteenMonth;
    }

    public function setFifteenMonth(?int $fifteenMonth): self
    {
        $this->fifteenMonth = $fifteenMonth;

        return $this;
    }

    public function getSixteenMonth(): ?int
    {
        return $this->sixteenMonth;
    }

    public function setSixteenMonth(?int $sixteenMonth): self
    {
        $this->sixteenMonth = $sixteenMonth;

        return $this;
    }

    public function getSeventeenMonth(): ?int
    {
        return $this->seventeenMonth;
    }

    public function setSeventeenMonth(?int $seventeenMonth): self
    {
        $this->seventeenMonth = $seventeenMonth;

        return $this;
    }

    public function getEighteenMonth(): ?int
    {
        return $this->eighteenMonth;
    }

    public function setEighteenMonth(?int $eighteenMonth): self
    {
        $this->eighteenMonth = $eighteenMonth;

        return $this;
    }

    public function getNineteenMonth(): ?int
    {
        return $this->nineteenMonth;
    }

    public function setNineteenMonth(?int $nineteenMonth): self
    {
        $this->nineteenMonth = $nineteenMonth;

        return $this;
    }

    public function getTwentyMonth(): ?int
    {
        return $this->twentyMonth;
    }

    public function setTwentyMonth(?int $twentyMonth): self
    {
        $this->twentyMonth = $twentyMonth;

        return $this;
    }

    public function getTwentyOneMonth(): ?int
    {
        return $this->twentyOneMonth;
    }

    public function setTwentyOneMonth(?int $twentyOneMonth): self
    {
        $this->twentyOneMonth = $twentyOneMonth;

        return $this;
    }

    public function getTwentyTwoMonth(): ?int
    {
        return $this->twentyTwoMonth;
    }

    public function setTwentyTwoMonth(?int $twentyTwoMonth): self
    {
        $this->twentyTwoMonth = $twentyTwoMonth;

        return $this;
    }

    public function getTwentyThreeMonth(): ?int
    {
        return $this->twentyThreeMonth;
    }

    public function setTwentyThreeMonth(?int $twentyThreeMonth): self
    {
        $this->twentyThreeMonth = $twentyThreeMonth;

        return $this;
    }

    public function setTwoYears(int $twoYears): self
    {
        $this->twoYears = $twoYears;

        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'oneMonth' => $this->oneMonth,
            'twoMonth' => $this->twoMonth,
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
            'thirteenMonth' => $this->thirteenMonth,
            'fourteenMonth' => $this->fourteenMonth,
            'fifteenMonth' => $this->fifteenMonth,
            'sixteenMonth' => $this->sixteenMonth,
            'seventeenMonth' => $this->seventeenMonth,
            'eighteenMonth' => $this->eighteenMonth,
            'nineteenMonth' => $this->nineteenMonth,
            'twentyMonth' => $this->twentyMonth,
            'twentyOneMonth' => $this->twentyOneMonth,
            'twentyTwoMonth' => $this->twentyTwoMonth,
            'twentyThreeMonth' => $this->twentyThreeMonth,
            'twoYears' => $this->twoYears
        ];
    }

    public function getOneMonth(): ?int
    {
        return $this->oneMonth;
    }

    public function setOneMonth(?int $oneMonth): self
    {
        $this->oneMonth = $oneMonth;

        return $this;
    }

    public function getTwoMonth(): ?int
    {
        return $this->twoMonth;
    }

    public function setTwoMonth(?int $twoMonth): self
    {
        $this->twoMonth = $twoMonth;

        return $this;
    }
}

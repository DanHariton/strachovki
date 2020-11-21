<?php


namespace App\Service;


use App\Entity\Insurance;
use App\Entity\InsurancePrice;
use Doctrine\ORM\EntityManagerInterface;

class InsurancePriceFactory
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Insurance $insurance
     * @return int|null
     */
    public function calculatePriceByAge(Insurance $insurance)
    {
        $now = new \DateTime();
        $interval = $now->diff($insurance->getDateBirth());
        if ($insurance->getInsuranceName() == Insurance::INSURANCE_MAXIMA) {
            if ($insurance->getInsuranceType() == Insurance::INSURANCE_TYPE_COMPLEX) {
                if ($interval->y >= 2 && $interval->y <= 17) {
                    $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                        ->findOneByName(InsurancePrice::PRICE_MAXIMA_YOUNG), $insurance->getInsuranceDuration()));
                }
                if ($interval->y >= 18 && $interval->y <= 30) {
                    $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                        ->findOneByName(InsurancePrice::PRICE_MAXIMA), $insurance->getInsuranceDuration()));
                }
                if ($interval->y >= 31 && $interval->y <= 50) {
                    $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                        ->findOneByName(InsurancePrice::PRICE_MAXIMA_MEDIUM), $insurance->getInsuranceDuration()));
                }
                if ($interval->y >= 51 && $interval->y <= 60) {
                    $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                        ->findOneByName(InsurancePrice::PRICE_MAXIMA_OLD), $insurance->getInsuranceDuration()));
                }
            } else {
                if ($interval->y >= 1 && $interval->y <= 30) {
                    $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                        ->findOneByName(InsurancePrice::PRICE_URGENT_MAXIMA), $insurance->getInsuranceDuration()));
                }
                if ($interval->y >= 31 && $interval->y <= 65) {
                    $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                        ->findOneByName(InsurancePrice::PRICE_URGENT_MAXIMA_MID), $insurance->getInsuranceDuration()));
                }
                if ($interval->y >= 66 && $interval->y <= 80) {
                    $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                        ->findOneByName(InsurancePrice::PRICE_URGENT_MAXIMA_OLD), $insurance->getInsuranceDuration()));
                }
            }
        }
        if ($insurance->getInsuranceName() == Insurance::INSURANCE_ERGO) {
            if ($interval->y >= 0 && $interval->y <= 14) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_ERGO_YOUNG), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 15 && $interval->y <= 26) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_ERGO), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 27 && $interval->y <= 65) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_ERGO_MEDIUM), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 66) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_ERGO_OLD), $insurance->getInsuranceDuration()));
            }
        }
        if ($insurance->getInsuranceName() == Insurance::INSURANCE_PVZP) {
            if ($interval->y >= 0 && $interval->y <= 5) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_PVZP_CHILD), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 6 && $interval->y <= 14) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_PVZP_YOUNG), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 15 && $interval->y <= 26) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_PVZP), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 27 && $interval->y <= 44) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_PVZP_MID), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 45 && $interval->y <= 59) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_PVZP_MEDIUM), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 60 && $interval->y <= 69) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_PVZP_OLD), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 70) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_PVZP_SENIOR), $insurance->getInsuranceDuration()));
            }
        }
        if ($insurance->getInsuranceName() == Insurance::INSURANCE_UNIQA) {
            if ($interval->y >= 0 && $interval->y <= 4) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_UNIQA_CHILD), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 5 && $interval->y <= 14) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_UNIQA_YOUNG), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 15 && $interval->y <= 39) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_UNIQA), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 40 && $interval->y <= 54) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_UNIQA_MID), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 55 && $interval->y <= 59) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_UNIQA_MEDIUM), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 60 && $interval->y <= 64) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_UNIQA_OLD), $insurance->getInsuranceDuration()));
            }
            if ($interval->y >= 65 && $interval->y <= 69) {
                $insurance->setPrice($this->setInsurancePrice($this->em->getRepository(InsurancePrice::class)
                    ->findOneByName(InsurancePrice::PRICE_UNIQA_SENIOR), $insurance->getInsuranceDuration()));
            }
        }

        return $insurance->getPrice();
    }

    /**
     * @param InsurancePrice $insurancePrice
     * @param $duration
     * @return int|null
     */
    private function setInsurancePrice(InsurancePrice $insurancePrice, $duration)
    {
        switch ($duration) {
            case 1:
                return $insurancePrice->getOneMonth();
            case 2:
                return $insurancePrice->getTwoMonth();
            case 3:
                return $insurancePrice->getThreeMonth();
            case 4:
                return $insurancePrice->getFourMonth();
            case 5:
                return $insurancePrice->getFiveMonth();
            case 6:
                return $insurancePrice->getSixMonth();
            case 7:
                return $insurancePrice->getSevenMonth();
            case 8:
                return $insurancePrice->getEightMonth();
            case 9:
                return $insurancePrice->getNineMonth();
            case 10:
                return $insurancePrice->getTenMonth();
            case 11:
                return $insurancePrice->getElevenMonth();
            case 12:
                return $insurancePrice->getYear();
            case 13:
                return $insurancePrice->getThirteenMonth();
            case 14:
                return $insurancePrice->getFourteenMonth();
            case 15:
                return $insurancePrice->getFifteenMonth();
            case 16:
                return $insurancePrice->getSixteenMonth();
            case 17:
                return $insurancePrice->getSeventeenMonth();
            case 18:
                return $insurancePrice->getEighteenMonth();
            case 19:
                return $insurancePrice->getNineteenMonth();
            case 20:
                return $insurancePrice->getTwentyMonth();
            case 21:
                return $insurancePrice->getTwentyOneMonth();
            case 22:
                return $insurancePrice->getTwentyTwoMonth();
            case 23:
                return $insurancePrice->getTwentyThreeMonth();
            default:
                return $insurancePrice->getTwoYears();
        }
    }
}
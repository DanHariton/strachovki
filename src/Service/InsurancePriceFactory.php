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

    public function calculatePriceByAge(Insurance $insurance)
    {
        $now = new \DateTime();
        $interval = $now->diff($insurance->getDateBirth());
        if ($insurance->getInsuranceName() == Insurance::INSURANCE_MAXIMA) {
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

        return $insurance->getPrice();
    }

    private function setInsurancePrice(InsurancePrice $insurancePrice, $duration)
    {
        switch ($duration) {
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
            default:
                return $insurancePrice->getTwoYears();
        }
    }
}
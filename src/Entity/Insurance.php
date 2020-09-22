<?php

namespace App\Entity;

use App\Repository\InsuranceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InsuranceRepository::class)
 */
class Insurance
{
    const INSURANCE_ERGO = 'ergo';
    const INSURANCE_UNIQA = 'uniqa';
    const INSURANCE_PVZP = 'pvzp';
    const INSURANCE_MAXIMA = 'maxima';
    const STATUS_NEW = 0;
    const STATUS_PAYED_SUCCESS = 1;
    const STATUS_PAYED_ERROR = 2;
    const PAYMENT_METHOD_ONLINE = 0;
    const PAYMENT_METHOD_CASH = 1;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $insuranceName;

    /**
     * @ORM\Column(type="integer")
     */
    private $insuranceDuration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateBirth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientSName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientMobile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $passportId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $citizenship;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paymentId;

    /**
     * @ORM\Column(type="integer", options={"default" = "0"})
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $snameInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobileInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $townInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $streetInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postCodeInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $genderInsurant;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateBirthInsurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paymentPassword;

    /**
     * @ORM\Column(type="integer")
     */
    private $paymentMethod;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $insuredNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $paidToInsuranceCompany;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sentToClient;

    public function __construct()
    {
        $this->status = self::STATUS_NEW;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInsuranceName(): ?string
    {
        return $this->insuranceName;
    }

    public function setInsuranceName(string $insuranceName): self
    {
        $this->insuranceName = $insuranceName;

        return $this;
    }

    public function getInsuranceDuration(): ?int
    {
        return $this->insuranceDuration;
    }

    public function setInsuranceDuration(int $insuranceDuration): self
    {
        $this->insuranceDuration = $insuranceDuration;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->dateBirth;
    }

    public function setDateBirth(\DateTimeInterface $dateBirth): self
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getClientSName(): ?string
    {
        return $this->clientSName;
    }

    public function setClientSName(string $clientSName): self
    {
        $this->clientSName = $clientSName;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): self
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    public function getClientMobile(): ?string
    {
        return $this->clientMobile;
    }

    public function setClientMobile(string $clientMobile): self
    {
        $this->clientMobile = $clientMobile;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getPassportId(): ?string
    {
        return $this->passportId;
    }

    public function setPassportId(string $passportId): self
    {
        $this->passportId = $passportId;

        return $this;
    }

    public function getCitizenship(): ?string
    {
        return $this->citizenship;
    }

    public function setCitizenship(string $citizenship): self
    {
        $this->citizenship = $citizenship;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    public function setPaymentId(?string $paymentId): self
    {
        $this->paymentId = $paymentId;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNameInsurant(): ?string
    {
        return $this->nameInsurant;
    }

    public function setNameInsurant(?string $nameInsurant): self
    {
        $this->nameInsurant = $nameInsurant;

        return $this;
    }

    public function getSnameInsurant(): ?string
    {
        return $this->snameInsurant;
    }

    public function setSnameInsurant(?string $snameInsurant): self
    {
        $this->snameInsurant = $snameInsurant;

        return $this;
    }

    public function getEmailInsurant(): ?string
    {
        return $this->emailInsurant;
    }

    public function setEmailInsurant(?string $emailInsurant): self
    {
        $this->emailInsurant = $emailInsurant;

        return $this;
    }

    public function getMobileInsurant(): ?string
    {
        return $this->mobileInsurant;
    }

    public function setMobileInsurant(?string $mobileInsurant): self
    {
        $this->mobileInsurant = $mobileInsurant;

        return $this;
    }

    public function getTownInsurant(): ?string
    {
        return $this->townInsurant;
    }

    public function setTownInsurant(?string $townInsurant): self
    {
        $this->townInsurant = $townInsurant;

        return $this;
    }

    public function getStreetInsurant(): ?string
    {
        return $this->streetInsurant;
    }

    public function setStreetInsurant(?string $streetInsurant): self
    {
        $this->streetInsurant = $streetInsurant;

        return $this;
    }

    public function getPostCodeInsurant(): ?string
    {
        return $this->postCodeInsurant;
    }

    public function setPostCodeInsurant(?string $postCodeInsurant): self
    {
        $this->postCodeInsurant = $postCodeInsurant;

        return $this;
    }

    public function getGenderInsurant(): ?string
    {
        return $this->genderInsurant;
    }

    public function setGenderInsurant(?string $genderInsurant): self
    {
        $this->genderInsurant = $genderInsurant;

        return $this;
    }

    public function getDateBirthInsurant(): ?\DateTimeInterface
    {
        return $this->dateBirthInsurant;
    }

    public function setDateBirthInsurant(?\DateTimeInterface $dateBirthInsurant): self
    {
        $this->dateBirthInsurant = $dateBirthInsurant;

        return $this;
    }

    public function getPaymentPassword(): ?string
    {
        return $this->paymentPassword;
    }

    public function setPaymentPassword(?string $paymentPassword): self
    {
        $this->paymentPassword = $paymentPassword;

        return $this;
    }

    public function getPaymentMethod(): ?int
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(int $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getInsuredNumber(): ?string
    {
        return $this->insuredNumber;
    }

    public function setInsuredNumber(?string $insuredNumber): self
    {
        $this->insuredNumber = $insuredNumber;

        return $this;
    }

    public function getPaidToInsuranceCompany(): ?bool
    {
        return $this->paidToInsuranceCompany;
    }

    public function setPaidToInsuranceCompany(?bool $paidToInsuranceCompany): self
    {
        $this->paidToInsuranceCompany = $paidToInsuranceCompany;

        return $this;
    }

    public function getSentToClient(): ?bool
    {
        return $this->sentToClient;
    }

    public function setSentToClient(?bool $sentToClient): self
    {
        $this->sentToClient = $sentToClient;

        return $this;
    }
}

<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bonus
 *
 * @ORM\Table(name="bonus")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\BonusRepository")
 */
class Bonus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="A2\UserBundle\Entity\Seller")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seller;

    /**
     * @var int
     *
     * @ORM\Column(name="bonusTotalBonus", type="integer")
     */
    private $totalBonus;

    /**
     * @ORM\ManyToOne(targetEntity="A2\CurrencyBundle\Entity\Currency", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $currency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="exerciseMonth", type="date")
     */
    private $exerciseMonth;

    /**
     * @ORM\Column(name="adminAdd", type="integer")
     */
    private $adminAdd;

    /**
     * @ORM\Column(name="dateAdd", type="datetime")
     */
    private $dateAdd;

    /**
     * @ORM\Column(name="userUpdate", type="integer", nullable=true)
     */
    private $userUpdate;

    /**
     * @ORM\Column(name="dateUpdate", type="datetime", nullable=true)
     */
    private $dateUpdate;

    /**
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set totalBonus
     *
     * @param integer $totalBonus
     *
     * @return Bonus
     */
    public function setTotalBonus($totalBonus)
    {
        $this->totalBonus = $totalBonus;

        return $this;
    }

    /**
     * Get totalBonus
     *
     * @return int
     */
    public function getTotalBonus()
    {
        return $this->totalBonus;
    }

    /**
     * Set exerciseMonth
     *
     * @param \DateTime $exerciseMonth
     *
     * @return Bonus
     */
    public function setExerciseMonth($exerciseMonth)
    {
        $this->exerciseMonth = $exerciseMonth;

        return $this;
    }

    /**
     * Get exerciseMonth
     *
     * @return \DateTime
     */
    public function getExerciseMonth()
    {
        return $this->exerciseMonth;
    }

    /**
     * Set adminAdd
     *
     * @param integer $adminAdd
     *
     * @return Bonus
     */
    public function setAdminAdd($adminAdd)
    {
        $this->adminAdd = $adminAdd;

        return $this;
    }

    /**
     * Get adminAdd
     *
     * @return integer
     */
    public function getAdminAdd()
    {
        return $this->adminAdd;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return Bonus
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set userUpdate
     *
     * @param integer $userUpdate
     *
     * @return Bonus
     */
    public function setUserUpdate($userUpdate)
    {
        $this->userUpdate = $userUpdate;

        return $this;
    }

    /**
     * Get userUpdate
     *
     * @return integer
     */
    public function getUserUpdate()
    {
        return $this->userUpdate;
    }

    /**
     * Set dateUpdate
     *
     * @param \DateTime $dateUpdate
     *
     * @return Bonus
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Bonus
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set seller
     *
     * @param \A2\UserBundle\Entity\Seller $seller
     *
     * @return Bonus
     */
    public function setSeller(\A2\UserBundle\Entity\Seller $seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return \A2\UserBundle\Entity\Seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set currency
     *
     * @param \A2\CurrencyBundle\Entity\Currency $currency
     *
     * @return Bonus
     */
    public function setCurrency(\A2\CurrencyBundle\Entity\Currency $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \A2\CurrencyBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
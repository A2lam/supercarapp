<?php

namespace A2\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="A2\CarBundle\Repository\CarRepository")
 */
class Car
{
    /**
     * @var int
     *
     * @ORM\Column(name="carId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="A2\CategoryBundle\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="A2\ModelBundle\Entity\Model", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="A2\ImageBundle\Entity\Image", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="A2\CurrencyBundle\Entity\Currency", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="energy", type="string", length=255)
     */
    private $energy;

    /**
     * @var string
     *
     * @ORM\Column(name="co2", type="string", length=255)
     */
    private $co2;

    /**
     * @var string
     *
     * @ORM\Column(name="gearBox", type="string", length=255)
     */
    private $gearBox;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="power", type="string", length=255)
     */
    private $power;

    /**
     * @var string
     *
     * @ORM\Column(name="maxSpeed", type="string", length=255)
     */
    private $maxSpeed;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="A2\StorehouseBundle\Entity\Storehouse", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $storehouse;

    /**
     * @var string
     *
     * @ORM\Column(name="isSold", type="boolean")
     */
    private $isSold;

    /**
     * @ORM\ManyToOne(targetEntity="A2\CustomerBundle\Entity\Customer", inversedBy="cars")
     */
    private $customer;

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
     * Set color
     *
     * @param string $color
     *
     * @return Car
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Car
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set energy
     *
     * @param string $energy
     *
     * @return Car
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;

        return $this;
    }

    /**
     * Get energy
     *
     * @return string
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * Set co2
     *
     * @param string $co2
     *
     * @return Car
     */
    public function setCo2($co2)
    {
        $this->co2 = $co2;

        return $this;
    }

    /**
     * Get co2
     *
     * @return string
     */
    public function getCo2()
    {
        return $this->co2;
    }

    /**
     * Set gearBox
     *
     * @param string $gearBox
     *
     * @return Car
     */
    public function setGearBox($gearBox)
    {
        $this->gearBox = $gearBox;

        return $this;
    }

    /**
     * Get gearBox
     *
     * @return string
     */
    public function getGearBox()
    {
        return $this->gearBox;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Car
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set power
     *
     * @param string $power
     *
     * @return Car
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return string
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set maxSpeed
     *
     * @param string $maxSpeed
     *
     * @return Car
     */
    public function setMaxSpeed($maxSpeed)
    {
        $this->maxSpeed = $maxSpeed;

        return $this;
    }

    /**
     * Get maxSpeed
     *
     * @return string
     */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set isSold
     *
     * @param boolean $isSold
     *
     * @return Car
     */
    public function setIsSold($isSold)
    {
        $this->isSold = $isSold;

        return $this;
    }

    /**
     * Get isSold
     *
     * @return boolean
     */
    public function getIsSold()
    {
        return $this->isSold;
    }

    /**
     * Set adminAdd
     *
     * @param integer $adminAdd
     *
     * @return Car
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
     * @return Car
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
     * @return Car
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
     * @return Car
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
     * @return Car
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
     * Set category
     *
     * @param \A2\CategoryBundle\Entity\Category $category
     *
     * @return Car
     */
    public function setCategory(\A2\CategoryBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \A2\CategoryBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set model
     *
     * @param \A2\ModelBundle\Entity\Model $model
     *
     * @return Car
     */
    public function setModel(\A2\ModelBundle\Entity\Model $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \A2\ModelBundle\Entity\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set image
     *
     * @param \A2\ImageBundle\Entity\Image $image
     *
     * @return Car
     */
    public function setImage(\A2\ImageBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \A2\ImageBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set currency
     *
     * @param \A2\CurrencyBundle\Entity\Currency $currency
     *
     * @return Car
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

    /**
     * Set customer
     *
     * @param \A2\CustomerBundle\Entity\Customer $customer
     *
     * @return Car
     */
    public function setCustomer(\A2\CustomerBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \A2\CustomerBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set storehouse
     *
     * @param \A2\StorehouseBundle\Entity\Storehouse $storehouse
     *
     * @return Car
     */
    public function setStorehouse(\A2\StorehouseBundle\Entity\Storehouse $storehouse)
    {
        $this->storehouse = $storehouse;

        return $this;
    }

    /**
     * Get storehouse
     *
     * @return \A2\StorehouseBundle\Entity\Storehouse
     */
    public function getStorehouse()
    {
        return $this->storehouse;
    }
}
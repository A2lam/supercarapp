<?php

namespace A2\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="A2\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="userName", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(name="userLastName", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\Column(name="userBday", type="datetime")
     * @Assert\DateTime()
     */
    private $bday;

    /**
     * @ORM\Column(name="userNum", type="string", length=255)
     * @Assert\Type(type="integer")
     */
    private $num;

    /**
     * @ORM\OneToOne(targetEntity="A2\AddressBundle\Entity\Address", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $address;

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
     * @ORM\Column(name="isActive", type="string", length=1)
     */
    private $isActive;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set bday
     *
     * @param \DateTime $bday
     *
     * @return User
     */
    public function setBday($bday)
    {
        $this->bday = $bday;

        return $this;
    }

    /**
     * Get bday
     *
     * @return \DateTime
     */
    public function getBday()
    {
        return $this->bday;
    }

    /**
     * Set num
     *
     * @param string $num
     *
     * @return User
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set adminAdd
     *
     * @param integer $adminAdd
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @param string $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return string
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set address
     *
     * @param \A2\AddressBundle\Entity\Address $address
     *
     * @return User
     */
    public function setAddress(\A2\AddressBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \A2\AddressBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }
}
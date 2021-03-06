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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="A2\ImageBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image;

    /**
     * @ORM\Column(name="usrName", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(name="usrLastname", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lastname;

    /**
     * @ORM\Column(name="usrBday", type="date")
     * @Assert\DateTime()
     */
    private $bday;

    /**
     * @ORM\Column(name="usrNum", type="string", length=255)
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
     * @ORM\Column(name="isActive", type="boolean")
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
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
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
     * @param boolean $isActive
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
     * @return boolean
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

    /**
     * Set image
     *
     * @param \A2\ImageBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\A2\ImageBundle\Entity\Image $image = null)
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
}
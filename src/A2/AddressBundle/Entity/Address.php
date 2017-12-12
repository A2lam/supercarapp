<?php

namespace A2\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="A2\AddressBundle\Repository\AddressRepository")
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="addressId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="addressStreetNb", type="integer", nullable=true)
     * @Assert\Type(type="integer")
     */
    private $streetNb;

    /**
     * @var string
     *
     * @ORM\Column(name="addressStreetName", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $streetName;

    /**
     * @var string
     *
     * @ORM\Column(name="addressComplement", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $complement;

    /**
     * @var int
     *
     * @ORM\Column(name="addressZipCode", type="integer")
     * @Assert\Type(type="integer")
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="addressTown", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="addressCountry", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $country;


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
     * Set complement
     *
     * @param string $complement
     *
     * @return Address
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set streetNb
     *
     * @param integer $streetNb
     *
     * @return Address
     */
    public function setStreetNb($streetNb)
    {
        $this->streetNb = $streetNb;

        return $this;
    }

    /**
     * Get streetNb
     *
     * @return integer
     */
    public function getStreetNb()
    {
        return $this->streetNb;
    }

    /**
     * Set streetName
     *
     * @param string $streetName
     *
     * @return Address
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set zipCode
     *
     * @param integer $zipCode
     *
     * @return Address
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return integer
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set town
     *
     * @param string $town
     *
     * @return Address
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
}
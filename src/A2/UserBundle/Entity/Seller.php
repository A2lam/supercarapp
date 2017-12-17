<?php

namespace A2\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Seller
 *
 * @ORM\Table(name="seller")
 * @ORM\Entity(repositoryClass="A2\UserBundle\Repository\SellerRepository")
 */
class Seller
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
     * @ORM\ManyToOne(targetEntity="A2\StorehouseBundle\Entity\Storehouse", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $storehouse;

    /**
     * @ORM\Column(name="sellerNbSales", type="integer")
     */
    private $nbSales;

    /**
     * @ORM\OneToOne(targetEntity="A2\UserBundle\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;


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
     * Set user
     *
     * @param \A2\UserBundle\Entity\User $user
     *
     * @return Seller
     */
    public function setUser(\A2\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \A2\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set nbSales
     *
     * @param integer $nbSales
     *
     * @return Seller
     */
    public function setNbSales($nbSales)
    {
        $this->nbSales = $nbSales;

        return $this;
    }

    /**
     * Get nbSales
     *
     * @return integer
     */
    public function getNbSales()
    {
        return $this->nbSales;
    }

    /**
     * Set storehouse
     *
     * @param \A2\StorehouseBundle\Entity\Storehouse $storehouse
     *
     * @return Seller
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
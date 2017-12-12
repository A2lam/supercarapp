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
    private $entrepot;

    /**
     * @ORM\Column(name="sellerNbVente", type="integer")
     */
    private $nbVente;

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
     * Set nbVente
     *
     * @param integer $nbVente
     *
     * @return Seller
     */
    public function setNbVente($nbVente)
    {
        $this->nbVente = $nbVente;

        return $this;
    }

    /**
     * Get nbVente
     *
     * @return integer
     */
    public function getNbVente()
    {
        return $this->nbVente;
    }

    /**
     * Set entrepot
     *
     * @param \A2\StorehouseBundle\Entity\Storehouse $entrepot
     *
     * @return Seller
     */
    public function setEntrepot(\A2\StorehouseBundle\Entity\Storehouse $entrepot)
    {
        $this->entrepot = $entrepot;

        return $this;
    }

    /**
     * Get entrepot
     *
     * @return \A2\StorehouseBundle\Entity\Storehouse
     */
    public function getEntrepot()
    {
        return $this->entrepot;
    }
}
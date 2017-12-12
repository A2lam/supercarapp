<?php

namespace A2\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Manager
 *
 * @ORM\Table(name="manager")
 * @ORM\Entity(repositoryClass="A2\UserBundle\Repository\ManagerRepository")
 */
class Manager
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
     * @ORM\OneToOne(targetEntity="A2\StorehouseBundle\Entity\Storehouse", mappedBy="manager", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $entrepot;

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
     * @return Manager
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
     * Set entrepot
     *
     * @param \A2\StorehouseBundle\Entity\Storehouse $entrepot
     *
     * @return Manager
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

<?php

namespace A2\StorehouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Storehouse
 *
 * @ORM\Table(name="storehouse")
 * @ORM\Entity(repositoryClass="A2\StorehouseBundle\Repository\StorehouseRepository")
 */
class Storehouse
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity="A2\AddressBundle\Entity\Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $adresse;

    /**
     * @ORM\OneToOne(targetEntity="A2\UserBundle\Entity\Manager", inversedBy="entrepot", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $manager;

    /**
     * @ORM\Column(name="adminCreation", type="integer")
     */
    private $adminCreation;

    /**
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(name="utilisateurModif", type="integer", nullable=true)
     */
    private $utModification;

    /**
     * @ORM\Column(name="dateModif", type="datetime", nullable=true)
     */
    private $dateModif;

    /**
     * @ORM\Column(name="estActif", type="string", length=1)
     */
    private $estActif;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Storehouse
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adminCreation
     *
     * @param integer $adminCreation
     *
     * @return Storehouse
     */
    public function setAdminCreation($adminCreation)
    {
        $this->adminCreation = $adminCreation;

        return $this;
    }

    /**
     * Get adminCreation
     *
     * @return integer
     */
    public function getAdminCreation()
    {
        return $this->adminCreation;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Storehouse
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set utModification
     *
     * @param integer $utModification
     *
     * @return Storehouse
     */
    public function setUtModification($utModification)
    {
        $this->utModification = $utModification;

        return $this;
    }

    /**
     * Get utModification
     *
     * @return integer
     */
    public function getUtModification()
    {
        return $this->utModification;
    }

    /**
     * Set dateModif
     *
     * @param \DateTime $dateModif
     *
     * @return Storehouse
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    /**
     * Get dateModif
     *
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * Set estActif
     *
     * @param string $estActif
     *
     * @return Storehouse
     */
    public function setEstActif($estActif)
    {
        $this->estActif = $estActif;

        return $this;
    }

    /**
     * Get estActif
     *
     * @return string
     */
    public function getEstActif()
    {
        return $this->estActif;
    }

    /**
     * Set adresse
     *
     * @param \A2\AddressBundle\Entity\Address $adresse
     *
     * @return Storehouse
     */
    public function setAdresse(\A2\AddressBundle\Entity\Address $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \A2\AddressBundle\Entity\Address
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set manager
     *
     * @param \A2\UserBundle\Entity\Manager $manager
     *
     * @return Storehouse
     */
    public function setManager(\A2\UserBundle\Entity\Manager $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return \A2\UserBundle\Entity\Manager
     */
    public function getManager()
    {
        return $this->manager;
    }
}
<?php

namespace A2\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="A2\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="utilisateurId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="utilisateurNom", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $nom;

    /**
     * @ORM\Column(name="utilisateurPrenom", type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $prenom;

    /**
     * @ORM\Column(name="utilisateurDdn", type="datetime")
     * @Assert\DateTime()
     */
    private $ddn;

    /**
     * @ORM\Column(name="utilisateurTel", type="string", length=255)
     * @Assert\Type(type="integer")
     */
    private $tel;

    /**
     * @ORM\OneToOne(targetEntity="A2\AddressBundle\Entity\Address", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $adresse;

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
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set ddn
     *
     * @param \DateTime $ddn
     *
     * @return User
     */
    public function setDdn($ddn)
    {
        $this->ddn = $ddn;

        return $this;
    }

    /**
     * Get ddn
     *
     * @return \DateTime
     */
    public function getDdn()
    {
        return $this->ddn;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set adminCreation
     *
     * @param integer $adminCreation
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
     */
    public function setAdresse(\A2\AddressBundle\Entity\Address $adresse = null)
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
}
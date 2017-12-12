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
}
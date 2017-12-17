<?php

namespace A2\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Orders
 *
 * @ORM\Table(name="order")
 * @ORM\Entity(repositoryClass="A2\OrderBundle\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="orderId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="A2\SupplierBundle\Entity\Supplier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $supplier;

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
     * @ORM\ManyToOne(targetEntity="A2\StorehouseBundle\Entity\Storehouse", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $storehouse;

    /**
     * @var int
     *
     * @ORM\Column(name="orderQuantity", type="integer")
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="orderDetails", type="text")
     * @Assert\NotBlank()
     */
    private $details;

    /**
     * @ORM\Column(name="isReceived", type="boolean")
     */
    private $isReceived;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Orders
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Orders
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set isReceived
     *
     * @param boolean $isReceived
     *
     * @return Orders
     */
    public function setIsReceived($isReceived)
    {
        $this->isReceived = $isReceived;

        return $this;
    }

    /**
     * Get isReceived
     *
     * @return boolean
     */
    public function getIsReceived()
    {
        return $this->isReceived;
    }

    /**
     * Set adminAdd
     *
     * @param integer $adminAdd
     *
     * @return Orders
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
     * @return Orders
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
     * @return Orders
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
     * @return Orders
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
     * @return Orders
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
     * Set supplier
     *
     * @param \A2\SupplierBundle\Entity\Supplier $supplier
     *
     * @return Orders
     */
    public function setSupplier(\A2\SupplierBundle\Entity\Supplier $supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * Get supplier
     *
     * @return \A2\SupplierBundle\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * Set category
     *
     * @param \A2\CategoryBundle\Entity\Category $category
     *
     * @return Orders
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
     * @return Orders
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
     * Set storehouse
     *
     * @param \A2\StorehouseBundle\Entity\Storehouse $storehouse
     *
     * @return Orders
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
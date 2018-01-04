<?php

namespace A2\SupplierBundle\Repository;
use A2\SupplierBundle\Entity\Supplier;

/**
 * SupplierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SupplierRepository extends \Doctrine\ORM\EntityRepository
{
    public function myFind($id)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->andWhere('s.isActive = :isActive')
            ->setParameter('isActive', 1)
        ;

        return $qb
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function myRemove($id)
    {
        $supplier = $this->myFind($id);
        $supplier->setIsActive(false);

        return;
    }

    public function getAdminName(Supplier $supplier, $action)
    {
        $query = $this->_em->createQuery('SELECT u.name, u.lastname FROM A2UserBundle:User u WHERE u.id = :id');

        if ($action == 'add')
            $query->setParameter('id', $supplier->getAdminAdd());
        else
            $query->setParameter('id', $supplier->getUserUpdate());

        $name = "";
        $results = $query->getArrayResult();
        foreach ($results as $result)
        {
            $name = $result['name'];
            $name .= ' ' .$result['lastname'];
        }

        return $name;
    }
}
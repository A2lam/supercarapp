<?php

namespace A2\BrandBundle\Repository;
use A2\BrandBundle\Entity\Brand;

/**
 * BrandRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BrandRepository extends \Doctrine\ORM\EntityRepository
{
    public function myFind($id)
    {
        $qb = $this->createQueryBuilder('b');
        $qb
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->andWhere('b.isActive = :isActive')
            ->setParameter('isActive', 1)
        ;

        return $qb
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function myRemove($id)
    {
        $brand = $this->myFind($id);
        $brand->setIsActive(false);

        return;
    }

    public function getAdminName(Brand $brand, $action)
    {
        $query = $this->_em->createQuery('SELECT u.name, u.lastname FROM A2UserBundle:User u WHERE u.id = :id');

        if ($action == 'add')
            $query->setParameter('id', $brand->getAdminAdd());
        else
            $query->setParameter('id', $brand->getUserUpdate());

        $name = "";
        $results = $query->getArrayResult();
        foreach ($results as $result)
        {
            $name = $result['name'];
            $name .= ' ' .$result['lastname'];
        }

        return $name;
    }

    public function findByKeyword($keyword)
    {
        $qb = $this->createQueryBuilder('b');

        $qb
            ->where('b.name LIKE \'%'. $keyword .'%\'')
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}
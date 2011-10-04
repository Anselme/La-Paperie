<?php

namespace Lapaperie\CompaniesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CompanieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompanieRepository extends EntityRepository
{
    public function findAllYear()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT a.year FROM LapaperieCompaniesBundle:Companie a
                ORDER BY a.year ASC'
            )
            ->getResult();
    }

    public function findAllNotPreviousYear()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieCompaniesBundle:Companie a
                WHERE a.isPreviousYear = 0
                ORDER BY a.year ASC'
            )
            ->getResult();
    }

    public function findAllByYearAsc($year)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieCompaniesBundle:Companie a
                WHERE a.year = :year
                ORDER BY a.year ASC'
            )->setParameter('year',$year)
            ->getResult();
    }

}

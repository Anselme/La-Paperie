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

    public function findAllByYearOrderByDebutResidence($year)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieCompaniesBundle:Companie a
                WHERE a.year = :year
                ORDER BY a.date_residence_beginning DESC'
            )->setParameter('year',$year)
            ->getResult();
    }

    public function findOneByYearOrderByDebutResidence($year)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieCompaniesBundle:Companie a
                WHERE a.year = :year
                ORDER BY a.date_residence_beginning DESC'
            )->setParameter('year',$year)
            ->setMaxresults(1)
            ->getResult();
    }

    public function findAllOrderByDebutResidenceDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieCompaniesBundle:Companie a
                ORDER BY a.date_residence_beginning DESC'
            )
            ->getResult();
    }

    public function createQBfindAllOrderByDebutResidenceDesc()
    {
        return $this->createQueryBuilder('n')->add('orderBy', 'n.date_residence_beginning DESC');
    }

}

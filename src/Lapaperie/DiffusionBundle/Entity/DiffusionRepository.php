<?php

namespace Lapaperie\DiffusionBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DiffusionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DiffusionRepository extends EntityRepository
{
    public function findAllOrderByYearDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM LapaperieDiffusionBundle:Diffusion a
                ORDER BY a.year DESC'
            )
            ->getResult();
    }

    public function findAllNotPreviousYear()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieDiffusionBundle:Diffusion a
                WHERE a.isPreviousYear = 0
                ORDER BY a.year ASC'
            )
            ->getResult();
    }
}

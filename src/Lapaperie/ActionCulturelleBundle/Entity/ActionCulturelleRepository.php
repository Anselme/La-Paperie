<?php

namespace Lapaperie\ActionCulturelleBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ActionCulturelleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActionCulturelleRepository extends EntityRepository
{
    public function findArchivesOrderByYearDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieActionCulturelleBundle:ActionCulturelle a
                WHERE a.isPreviousYear = 1
                ORDER BY a.year DESC'
            )
            ->getResult();
    }

    public function findAllNotPreviousYear()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  a FROM LapaperieActionCulturelleBundle:ActionCulturelle a
                WHERE a.isPreviousYear = 0
                ORDER BY a.year ASC'
            )
            ->getResult();
    }

    public function findByImageId($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
                   FROM LapaperieActionCulturelleBundle:ActionCulturelle a
                   JOIN a.gallery g
                   JOIN g.images i
                  WHERE i.id = :id
                 '
             )->setParameter('id',$id)
             ->getResult();
    }

    public function findByFileUploadId($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
                   FROM LapaperieActionCulturelleBundle:ActionCulturelle a
                   JOIN a.directory g
                   JOIN g.fileUpload i
                  WHERE i.id = :id
                 '
             )->setParameter('id',$id)
             ->getResult();
    }
}

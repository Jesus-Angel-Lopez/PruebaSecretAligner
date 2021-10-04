<?php

namespace App\Repository;

use App\Entity\Sdgdsg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sdgdsg|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sdgdsg|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sdgdsg[]    findAll()
 * @method Sdgdsg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SdgdsgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sdgdsg::class);
    }

    // /**
    //  * @return Sdgdsg[] Returns an array of Sdgdsg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sdgdsg
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

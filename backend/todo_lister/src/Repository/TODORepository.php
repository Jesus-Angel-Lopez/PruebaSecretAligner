<?php

namespace App\Repository;

use App\Entity\TODO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TODO|null find($id, $lockMode = null, $lockVersion = null)
 * @method TODO|null findOneBy(array $criteria, array $orderBy = null)
 * @method TODO[]    findAll()
 * @method TODO[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TODORepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TODO::class);
    }

    // /**
    //  * @return TODO[] Returns an array of TODO objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TODO
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

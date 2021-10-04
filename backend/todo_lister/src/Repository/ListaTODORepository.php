<?php

namespace App\Repository;

use App\Entity\ListaTODO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListaTODO|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListaTODO|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListaTODO[]    findAll()
 * @method ListaTODO[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListaTODORepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListaTODO::class);
    }

    // /**
    //  * @return ListaTODO[] Returns an array of ListaTODO objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListaTODO
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

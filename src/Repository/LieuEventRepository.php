<?php

namespace App\Repository;

use App\Entity\LieuEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LieuEvent>
 *
 * @method LieuEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method LieuEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method LieuEvent[]    findAll()
 * @method LieuEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LieuEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LieuEvent::class);
    }

//    /**
//     * @return LieuEvent[] Returns an array of LieuEvent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LieuEvent
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

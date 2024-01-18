<?php

namespace App\Repository;

use App\Entity\TempsTransport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TempsTransport>
 *
 * @method TempsTransport|null find($id, $lockMode = null, $lockVersion = null)
 * @method TempsTransport|null findOneBy(array $criteria, array $orderBy = null)
 * @method TempsTransport[]    findAll()
 * @method TempsTransport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TempsTransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TempsTransport::class);
    }

//    /**
//     * @return TempsTransport[] Returns an array of TempsTransport objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TempsTransport
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

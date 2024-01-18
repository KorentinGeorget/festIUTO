<?php

namespace App\Repository;

use App\Entity\PossedeBillet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PossedeBillet>
 *
 * @method PossedeBillet|null find($id, $lockMode = null, $lockVersion = null)
 * @method PossedeBillet|null findOneBy(array $criteria, array $orderBy = null)
 * @method PossedeBillet[]    findAll()
 * @method PossedeBillet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PossedeBilletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PossedeBillet::class);
    }

//    /**
//     * @return PossedeBillet[] Returns an array of PossedeBillet objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PossedeBillet
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

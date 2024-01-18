<?php

namespace App\Repository;

use App\Entity\TypeBillet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeBillet>
 *
 * @method TypeBillet|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeBillet|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeBillet[]    findAll()
 * @method TypeBillet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeBilletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBillet::class);
    }

//    /**
//     * @return TypeBillet[] Returns an array of TypeBillet objects
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

//    public function findOneBySomeField($value): ?TypeBillet
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

<?php

namespace App\Repository;

use App\Entity\Spectateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Spectateur>
 *
 * @method Spectateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spectateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spectateur[]    findAll()
 * @method Spectateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpectateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spectateur::class);
    }

//    /**
//     * @return Spectateur[] Returns an array of Spectateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Spectateur
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

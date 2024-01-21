<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evenement>
 *
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

//    /**
//     * @return Evenement[] Returns an array of Evenement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Evenement
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findEvenementsByFestival($id): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.festival = :id')
            ->setParameter('id', $id)
            ->orderBy('e.dateEv', 'ASC')
            ->addOrderBy('e.heureDebut', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findEvenementsByMembre($id): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.groupe = :id')
            ->setParameter('id', $id)
            ->orderBy('e.dateEv', 'ASC')
            ->addOrderBy('e.heureDebut', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findEvenementBySpectateur($id): array
    {
        return $this->createQueryBuilder('e')
            ->join('e.spectateurs', 's')
            ->andWhere('s.id = :id')
            ->setParameter('id', $id)
            ->orderBy('e.dateEv', 'ASC')
            ->addOrderBy('e.heureDebut', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findEvenementWhereGroupeFavoris($id): array
    {
        return $this->createQueryBuilder('e')
            ->join('e.groupe', 'g')
            ->andWhere('g.id in (:id)')
            ->setParameter('id', $id)
            ->orderBy('e.dateEv', 'ASC')
            ->addOrderBy('e.heureDebut', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function EvenementNotInFestival(): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.festival IS NULL')
            ->orderBy('e.dateEv', 'ASC')
            ->addOrderBy('e.heureDebut', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

}

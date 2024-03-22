<?php

namespace App\Repository;

use App\Entity\Avilibility;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Avilibility>
 *
 * @method Avilibility|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avilibility|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avilibility[]    findAll()
 * @method Avilibility[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvilibilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avilibility::class);
    }

//    /**
//     * @return Avilibility[] Returns an array of Avilibility objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Avilibility
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

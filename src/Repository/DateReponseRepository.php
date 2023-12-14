<?php

namespace App\Repository;

use App\Entity\DateReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DateReponse>
 *
 * @method DateReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateReponse[]    findAll()
 * @method DateReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateReponse::class);
    }

//    /**
//     * @return DateReponse[] Returns an array of DateReponse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DateReponse
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

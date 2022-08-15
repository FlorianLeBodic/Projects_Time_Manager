<?php

namespace App\Repository;

use App\Entity\HoursOnTheRoad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HoursOnTheRoad>
 *
 * @method HoursOnTheRoad|null find($id, $lockMode = null, $lockVersion = null)
 * @method HoursOnTheRoad|null findOneBy(array $criteria, array $orderBy = null)
 * @method HoursOnTheRoad[]    findAll()
 * @method HoursOnTheRoad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoursOnTheRoadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HoursOnTheRoad::class);
    }

    public function add(HoursOnTheRoad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HoursOnTheRoad $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HoursOnTheRoad[] Returns an array of HoursOnTheRoad objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HoursOnTheRoad
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

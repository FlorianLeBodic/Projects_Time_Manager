<?php

namespace App\Repository;

use App\Entity\HoursToCustomerCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HoursToCustomerCompany>
 *
 * @method HoursToCustomerCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method HoursToCustomerCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method HoursToCustomerCompany[]    findAll()
 * @method HoursToCustomerCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoursToCustomerCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HoursToCustomerCompany::class);
    }

    public function add(HoursToCustomerCompany $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HoursToCustomerCompany $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HoursToCustomerCompany[] Returns an array of HoursToCustomerCompany objects
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

//    public function findOneBySomeField($value): ?HoursToCustomerCompany
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

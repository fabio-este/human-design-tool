<?php

namespace App\Repository;

use App\Entity\DescriptionDesign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DescriptionDesign>
 *
 * @method DescriptionDesign|null find($id, $lockMode = null, $lockVersion = null)
 * @method DescriptionDesign|null findOneBy(array $criteria, array $orderBy = null)
 * @method DescriptionDesign[]    findAll()
 * @method DescriptionDesign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptionDesignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DescriptionDesign::class);
    }

    public function add(DescriptionDesign $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DescriptionDesign $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DescriptionDesign[] Returns an array of DescriptionDesign objects
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

//    public function findOneBySomeField($value): ?DescriptionDesign
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

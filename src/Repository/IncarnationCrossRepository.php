<?php

namespace App\Repository;

use App\Entity\Gate;
use App\Entity\IncarnationCross;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IncarnationCross>
 *
 * @method IncarnationCross|null find($id, $lockMode = null, $lockVersion = null)
 * @method IncarnationCross|null findOneBy(array $criteria, array $orderBy = null)
 * @method IncarnationCross[]    findAll()
 * @method IncarnationCross[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncarnationCrossRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IncarnationCross::class);
    }

    public function add(IncarnationCross $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IncarnationCross $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Gate $sunDesign
     * @param Gate $earthDesign
     * @param Gate $sunPersonality
     * @param Gate $earthPersonality
     * @return int|mixed|string|null
     * @throws NonUniqueResultException
     */
    public function getIncarnationCrossByGates(Gate $sunPersonality, Gate $earthPersonality, Gate $sunDesign, Gate $earthDesign): ?IncarnationCross
    {

        $qb = $this->createQueryBuilder('i');
        return $qb
            ->innerJoin('i.sunPersonality', 'sunPersonality')
            ->andWhere('sunPersonality.id = :sunPersonality')
            ->setParameter('sunPersonality', $sunPersonality->getId())
            ->innerJoin('i.earthPersonality', 'earthPersonality')
            ->andWhere('earthPersonality.id = :earthPersonality')
            ->setParameter('earthPersonality', $earthPersonality->getId())
            ->innerJoin('i.sunDesign', 'sunDesign')
            ->andWhere('sunDesign.id = :sunDesign')
            ->setParameter('sunDesign', $sunDesign->getId())
            ->innerJoin('i.earthDesign', 'earthDesign')
            ->andWhere('earthDesign.id = :earthDesign')
            ->setParameter('earthDesign', $earthDesign->getId())
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return IncarnationCross[] Returns an array of IncarnationCross objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IncarnationCross
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

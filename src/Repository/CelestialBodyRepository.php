<?php

namespace App\Repository;

use App\Entity\CelestialBody;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CelestialBody>
 *
 * @method CelestialBody|null find($id, $lockMode = null, $lockVersion = null)
 * @method CelestialBody|null findOneBy(array $criteria, array $orderBy = null)
 * @method CelestialBody[]    findAll()
 * @method CelestialBody[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CelestialBodyRepository extends ServiceEntityRepository
{

    protected $cache = NULL;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CelestialBody::class);
    }

    public function add(CelestialBody $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CelestialBody $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CelestialBody[] Returns an array of CelestialBody objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function getCelestialBodyByIdentifier($identifier){

        // init cache
        if($this->cache === NULL){
          $allCelestialBodies = $this->findAll();

          foreach($allCelestialBodies as $celestialBody){
            $this->cache[$celestialBody->getIdentifier()] = $celestialBody;
          }
        }

        return $this->cache[$identifier];
    }

    public function getCelestialBodiesByIdentifier(){

        // init cache
        if($this->cache === NULL){
          $allCelestialBodies = $this->findAll();

          foreach($allCelestialBodies as $celestialBody){
            $this->cache[$celestialBody->getIdentifier()] = $celestialBody;
          }
        }

        return $this->cache;
    }
}

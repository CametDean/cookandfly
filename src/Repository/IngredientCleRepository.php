<?php

namespace App\Repository;

use App\Entity\IngredientCle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IngredientCle|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientCle|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientCle[]    findAll()
 * @method IngredientCle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientCleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientCle::class);
    }

    // /**
    //  * @return IngredientCle[] Returns an array of IngredientCle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientCle
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

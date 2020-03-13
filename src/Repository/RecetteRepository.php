<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    // /**
    //  * @return Recette[] Returns an array of Recette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    // /**
    //  * @return Recette[] Returns an array of Recette objects
    //  */
    
    public function findByName($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.nom LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->orderBy('r.nom', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    
    /* public function findOneByName($value): ?Recette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.nom LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->getQuery()
            ->getOneOrNullResult()
        ;
    } */
    
}

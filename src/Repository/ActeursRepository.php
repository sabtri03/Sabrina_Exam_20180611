<?php

namespace App\Repository;

use App\Entity\Acteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Acteurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acteurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acteurs[]    findAll()
 * @method Acteurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActeursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Acteurs::class);
    }

//    /**
//     * @return Acteurs[] Returns an array of Acteurs objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acteurs
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

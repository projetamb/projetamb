<?php

namespace App\Repository;

use App\Entity\Disciplines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Disciplines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disciplines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disciplines[]    findAll()
 * @method Disciplines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisciplinesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Disciplines::class);
    }

    // /**
    //  * @return Disciplines[] Returns an array of Disciplines objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Disciplines
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\PostsByAuthors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PostsByAuthors|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostsByAuthors|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostsByAuthors[]    findAll()
 * @method PostsByAuthors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsByAuthorsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PostsByAuthors::class);
    }

//    /**
//     * @return PostsByAuthors[] Returns an array of PostsByAuthors objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostsByAuthors
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

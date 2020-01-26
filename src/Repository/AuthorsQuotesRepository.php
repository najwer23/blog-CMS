<?php

namespace App\Repository;

use App\Entity\AuthorsQuotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AuthorsQuotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthorsQuotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthorsQuotes[]    findAll()
 * @method AuthorsQuotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorsQuotesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AuthorsQuotes::class);
    }

//    /**
//     * @return AuthorsQuotes[] Returns an array of AuthorsQuotes objects
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
    public function findOneBySomeField($value): ?AuthorsQuotes
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

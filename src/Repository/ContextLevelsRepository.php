<?php

namespace App\Repository;

use App\Entity\ContextLevels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContextLevels|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContextLevels|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContextLevels[]    findAll()
 * @method ContextLevels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContextLevelsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContextLevels::class);
    }

    /**
     * @param $contextLevelName
     * @return ContextLevels Returns  ContextLevels objects
     */
    public function getContextByName($contextLevelName) {
        $entityManger = $this->getDoctrine()->getManager();
        $contextLevel = $entityManger->getRepository('App:ContextLevel')->findOneBy(
            ['name' =>$contextLevelName]
        );
        return $contextLevel;

    }

    // /**
    //  * @return ContextLevels[] Returns an array of ContextLevels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContextLevels
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

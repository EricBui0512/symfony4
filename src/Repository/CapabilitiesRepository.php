<?php

namespace App\Repository;

use App\Entity\Capabilities;
use App\Repository\Interfaces\CapabilityRepoInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Capabilities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capabilities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capabilities[]    findAll()
 * @method Capabilities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapabilitiesRepository extends ServiceEntityRepository implements CapabilityRepoInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Capabilities::class);
    }



    /**
     * @param $capabilityName
     * @return Capabilities Return Capabilities objects
     */
    public function getCapabilityByName($capabilityName) {
        $entityManager = $this->getDoctrine()->getManager();
        $capability = $entityManager->getRepository('App:Capabilities')->findOneBy(
            ['name' => $capabilityName]
        );
        return $capability;
    }




    // /**
    //  * @return Capabilities[] Returns an array of Capabilities objects
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
    public function findOneBySomeField($value): ?Capabilities
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

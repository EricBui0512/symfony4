<?php

namespace App\Repository;

use App\Entity\RoleCapabilities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoleCapabilities|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleCapabilities|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleCapabilities[]    findAll()
 * @method RoleCapabilities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleCapabilitiesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoleCapabilities::class);
    }


    /**
     * @param $roleId
     * @param $contextLevelId
     * @param $capabilityId
     * @return bool
     */
    public function hasThisCapability($roleId, $contextLevelId, $capabilityId) {
        $entityManager = $this->getDoctrine()->getManager();
        $roleCapabilities = $entityManager->getRepository('App:RoleCapabilities')->findOneBy(
            ['role_id' => $roleId],
            ['context_level' => $contextLevelId],
            ['capability' => $capabilityId]
        );

        if($roleCapabilities == null){
            return false;
        }
        return true;
    }

    // /**
    //  * @return RoleCapabilities[] Returns an array of RoleCapabilities objects
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

    /*
    public function findOneBySomeField($value): ?RoleCapabilities
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

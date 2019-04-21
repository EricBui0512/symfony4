<?php
/**
 * Created by IntelliJ IDEA.
 * User: tuongbui
 * Date: 21/4/19
 * Time: 2:44 PM
 */

namespace App\Repository;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * Optional EntityRepository base class with a simplified constructor (for autowiring).
 *
 * To use in your class, inject the "registry" service and call
 * the parent constructor. For example:
 *
 * class YourEntityRepository extends ServiceEntityRepository
 * {
 *     public function __construct(RegistryInterface $registry)
 *     {
 *         parent::__construct($registry, YourEntity::class);
 *     }
 * }
 */
class CustomizedServiceEntityRepository extends ServiceEntityRepository
{
    protected $entityRepo;
    public function __construct(RegistryInterface $registry, $entityClass)
    {
        /**
         * @param string $entityClass The class name of the entity this repository manages
         */
        parent::__construct($registry, $entityClass);
        $this->entityRepo = $this->getDoctrine()->getManager()->getRepository($entityClass);

    }

}
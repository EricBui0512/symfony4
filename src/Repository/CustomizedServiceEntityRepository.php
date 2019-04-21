<?php
/**
 * Created by IntelliJ IDEA.
 * User: tuongbui
 * Date: 21/4/19
 * Time: 2:44 PM
 */

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class CustomizedServiceEntityRepository extends ServiceEntityRepository
{
    protected $entityRepo;
    public function __construct(RegistryInterface $registry, $entityClass)
    {
        parent::__construct($registry, $entityClass);
        $this->entityRepo = $this->getDoctrine()->getManager()->getRepository($entityClass);

    }

}
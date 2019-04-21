<?php

namespace App\Repository;

use App\Entity\Role;
use App\Repository\CustomizedServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends CustomizedServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Role::class);
    }

}

<?php

namespace App\Repository;

use App\Entity\RoleAssignment;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Repository\CustomizedServiceEntityRepository;

/**
 * @method RoleAssignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleAssignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleAssignment[]    findAll()
 * @method RoleAssignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleAssignmentRepository extends CustomizedServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoleAssignment::class);
    }

    /**
     * @param $userId
     * @param $contextId
     * @return RoleAssignment[] Returns an array of RoleAssignment objects
     */
    public function getUserRoles($userId, $contextId) {
        $userRoles = $this->entityRepo->findBy(
            ['user_id' => $userId],
            ['context_id' => $contextId]
        );
        return $userRoles;

    }
}

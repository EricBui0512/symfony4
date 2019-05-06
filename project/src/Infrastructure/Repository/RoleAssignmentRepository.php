<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Role\RoleAssignmentRepoInterface;
use App\Domain\Entity\Role\RoleAssignment;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method RoleAssignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleAssignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleAssignment[]    findAll()
 * @method RoleAssignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleAssignmentRepository implements RoleAssignmentRepoInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     * ArticleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(RoleAssignment::class);
    }

    public function getObjectById(int $id): RoleAssignment
    {
        return $this->objectRepository->find($id);
    }


    /**
     * @param $userId
     * @param $contextId
     * @return array
     */
    public function getUserRoles($userId, $contextId): array
    {
        $userRoles = $this->objectRepository->findBy(array(
            'user_id' => $userId,
            'context_id' => $contextId
        ));
        return $userRoles;

    }
}

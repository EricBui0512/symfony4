<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Group\UsersGroup;
use App\Domain\Entity\Group\GroupUsersRepoInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 */
class GroupUsersRepository implements GroupUsersRepoInterface
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
        $this->objectRepository = $this->entityManager->getRepository(UsersGroup::class);
    }


    /**
     * @param int $id
     * @return UsersGroup
     */
    public function getObjectById(int $id): UsersGroup
    {
        return $this->entityRepo->find($id);
    }


    /**
     * @param UsersGroup $usersGroup
     * @return UsersGroup
     */
    public function createObject(UsersGroup $usersGroup): UsersGroup
    {
        $this->entityManager->persist($usersGroup);
        $this->entityManager->flush();
        return $usersGroup;
    }


    /**
     * @param UsersGroup $usersGroup
     */
    public function removeObject(UsersGroup $usersGroup): void
    {

        $this->entityManager->remove($usersGroup);
        $this->entityManager->flush();
    }


    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function isUserExistInGroup($userId, $groupId) : bool
    {
        $userInGroup = $this->objectRepository->findOneBy(array(
            'user_id' => $userId,
            'group_id' => $groupId));

        return ($userInGroup != null) ? true : false;
    }


    /**
     * @param int $groupId
     * @param int $userId
     * @return UsersGroup
     */
    public function getUserGroupByUserIdGroupId(int $groupId, int $userId): UsersGroup
    {
        $userInGroup = $this->objectRepository->findOneBy(array(
            'user_id' => $userId,
            'group_id' => $groupId));
        return $userInGroup;
    }


    /**
     * @param int $groupId
     * @return bool
     */
    public function isEmptyGroup(int $groupId): bool
    {
        $userInGroup = $this->objectRepository->findOneBy(array(
            'group_id' => $groupId));
        return ($userInGroup == null) ? true: false;
    }

    public function removeUserGroupById($groupId, $userId) {
        $entityManager = $this->getDoctrine()->getManager();
        $userInGroups = $this->entityRepo->findBy(
            ['user_id' => $userId],
            ['group_id' => $groupId]);
        foreach ($userInGroups as $userInGroup) {
            $entityManager->remove($userInGroup);
        }
        $entityManager->flush();
        return true;

    }

}

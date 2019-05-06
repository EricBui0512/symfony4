<?php



namespace App\Domain\Entity\Group;

interface GroupUsersRepoInterface
{
    /**
     * @param int $id
     * @return UsersGroup
     */
    public function getObjectById(int $id): UsersGroup;

    /**
     * @param UsersGroup $usersGroup
     * @return UsersGroup
     */
    public function createObject(UsersGroup $usersGroup): UsersGroup;


    /**
     * @param UsersGroup $usersGroup
     */
    public function removeObject(UsersGroup $usersGroup): void;

    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function isUserExistInGroup($userId, $groupId) : bool;

    /**
     * @param int $groupId
     * @param int $userId
     * @return UsersGroup
     */
    public function getUserGroupByUserIdGroupId(int $groupId, int $userId): UsersGroup;


    /**
     * @param int $groupId
     * @return bool
     */
    public function isEmptyGroup(int $groupId): bool;

    public function removeUserGroupByID($groupId, $userId);

}
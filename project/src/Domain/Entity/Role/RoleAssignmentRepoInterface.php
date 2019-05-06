<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 10:20 PM
 */

namespace App\Domain\Entity\Role;


interface RoleAssignmentRepoInterface
{
    /**
     * @param $userId
     * @param $contextId
     * @return array
     */
    public function getUserRoles($userId, $contextId): array ;

    /**
     * @param int $id
     * @return RoleAssignment
     */
    public function getObjectById(int $id): RoleAssignment;

}
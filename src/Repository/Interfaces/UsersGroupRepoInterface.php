<?php

namespace App\Repository\Interfaces;


interface UsersGroupRepoInterface extends RepoInterface
{

    public function isUserExistInGroup($userId, $groupId);

    public function removeUserGroupByID($groupId, $userId);

}
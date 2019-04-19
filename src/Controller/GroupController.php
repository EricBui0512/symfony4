<?php

namespace App\Controller;

use App\Repository\Interfaces\GroupRepoInterface;
use App\Repository\Interfaces\UsersGroupRepoInterface;


class GroupController
{

    private $groupRepo;
    private $userGroupRepo;

    public function __construct(GroupRepoInterface $groupRepoInterface, UsersGroupRepoInterface $usersGroupRepoInterface) {
        $this->groupRepo = $groupRepoInterface;
        $this->userGroupRepo = $usersGroupRepoInterface;

    }


    public function createGroup($userId, $data) {
        if(!CapabilityGroupController::isCreateGroupCapability($userId)){
            return false;
        }
        $data['modified_id'] = $userId;
        return $this->groupRepo->createObject($data);
    }


    public function addUserToGroup($authorId,$groupId, $userId){
        if(!CapabilityGroupController::isAssignUserToGroupCapability($authorId, $groupId)){
            return false;
        }

        if ($this->userGroupRepo->isUserExistInGroup($userId, $groupId)){
            return false;
        }
        $data = array();
        $data['userId'] = $userId;
        $data['groupId'] = $groupId;
        $data['modifierId'] = $authorId;
        return $this->userGroupRepo->createObject($data);
    }

    public function removeUserFromGroup($authorId, $groupId, $userId) {

        if(!CapabilityGroupController::isDeleteUserCapability($authorId, $groupId)){
            return false;
        }

        if (! $this->userGroupRepo->isUserExistInGroup($userId, $groupId)){
            return false;
        }
        return $this->userGroupRepo->removeUserGroupByID($groupId, $userId);

    }

    public function deleteGroup($authorId, $groupId){
        if(!CapabilityGroupController::isDeleteGroupCapablity($authorId, $groupId)){
            return false;
        }
        if (! $this->groupRepo->isEmptyGroup($groupId)){
            return false;
        }
        return $this->groupRepo->removeObject($groupId);

    }



}
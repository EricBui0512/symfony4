<?php

namespace App\Controller;

use App\Repository\Interfaces\GroupRepoInterface;
use App\Repository\Interfaces\UsersGroupRepoInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupController extends AbstractController
{

    private $groupRepo;
    private $userGroupRepo;

    public function __construct(GroupRepoInterface $groupRepoInterface, UsersGroupRepoInterface $usersGroupRepoInterface) {
        $this->groupRepo = $groupRepoInterface;
        $this->userGroupRepo = $usersGroupRepoInterface;

    }


    /**
     * @param $userId
     * @param $data
     * @return bool
     */
    public function createGroup($authorId, $data) {
        $capabilityGroupController = new CapabilityGroupController();
        if(!$capabilityGroupController->isCreateGroupCapability($authorId)){
            return false;
        }
        $data['modified_id'] = $authorId;
        return $this->groupRepo->createObject($data);
    }


    /**
     * @param $authorId
     * @param $groupId
     * @param $userId
     * @return bool
     */
    public function addUserToGroup($authorId,$groupId, $userId){
        $capabilityGroupController = new CapabilityGroupController();
        if(!$capabilityGroupController->isAssignUserToGroupCapability($authorId, $groupId)){
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

    /**
     * @param $authorId
     * @param $groupId
     * @param $userId
     * @return bool
     */
    public function removeUserFromGroup($authorId, $groupId, $userId) {
        $capabilityGroupController = new CapabilityGroupController();
        if(!$capabilityGroupController->isDeleteUserCapability($authorId, $groupId)){
            return false;
        }

        if (! $this->userGroupRepo->isUserExistInGroup($userId, $groupId)){
            return false;
        }
        return $this->userGroupRepo->removeUserGroupByID($groupId, $userId);

    }

    /**
     * @param $authorId
     * @param $groupId
     * @return bool
     */
    public function deleteGroup($authorId, $groupId){
        $capabilityGroupController = new CapabilityGroupController();
        if(!$capabilityGroupController->isDeleteGroupCapablity($authorId, $groupId)){
            return false;
        }
        if (! $this->groupRepo->isEmptyGroup($groupId)){
            return false;
        }
        return $this->groupRepo->removeObject($groupId);

    }



}
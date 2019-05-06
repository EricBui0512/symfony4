<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 6/5/19
 * Time: 1:58 AM
 */

namespace App\Application\Service;


use App\Application\Service\Authorization\CapabilityGroupAdminService;
use App\Domain\Entity\Group\ChatGroup;
use App\Domain\Entity\Group\GroupRepoInterface;
use App\Domain\Entity\Group\GroupUsersRepoInterface;
use App\Domain\Entity\Group\UsersGroup;
use Symfony\Component\Cache\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\EntityNotFoundException;
use App\Domain\Entity\User\UserRepoInterface;

class GroupService
{
    private $groupRepo;
    private $groupUserRepo;
    private $capabilityGroupAdminService;
    private $userRepo;

    public function __construct(GroupRepoInterface $groupRepoInterface, GroupUsersRepoInterface $groupUsersRepoInterface
            , CapabilityGroupAdminService $capabilityGroupAdminService, UserRepoInterface $userRepoInterface) {
        $this->groupRepo = $groupRepoInterface;
        $this->groupUserRepo = $groupUsersRepoInterface;
        $this->capabilityGroupAdminService = $capabilityGroupAdminService;
        $this->userRepo = $userRepoInterface;

    }


    /**
     * @param int $creatorId
     * @param string $groupName
     * @return Group
     */
    public function createGroup(int $creatorId, string $groupName): ChatGroup
    {
        if(! $this->capabilityGroupAdminService->isCreateGroupCapability($creatorId)){
            throw new AuthenticationException("This user" . $creatorId . " does not have create group capability");
        }
        $group = new ChatGroup();
        $group->setName($groupName);
        $group->setModifierId($creatorId);

        $date = new \DateTime("2018-05-09 00:00:00");
        $group->setTimeModified($date);

        $this->groupRepo->createObject($group);
        return $group;
    }


    /**
     * @param int $authorId
     * @param int $groupId
     * @throws EntityNotFoundException
     */
    public function deleteGroup(int $authorId, int $groupId): void
    {
        if(! $this->capabilityGroupAdminService->isDeleteGroupCapability($authorId, $groupId)){
            throw new AuthenticationException("This user" . $authorId . " does not have create group capability");
        }

        $group = $this->groupRepo->getObjectById($groupId);
        if (! $group){
            throw new EntityNotFoundException('Group with id '.$groupId.' does not exist!');
        }

        if (!$this->groupUserRepo->isEmptyGroup($groupId)) {
            throw new AuthenticationException('Group with id '.$groupId.' is not empty, can not delete!');
        }

        $this->groupRepo->removeObject($group);

    }





    /**
     * @param $authorId
     * @param $groupId
     * @param $userId
     * @return UsersGroup
     * @throws EntityNotFoundException
     */
    public function addUserToGroup($authorId,$groupId, $userId): UsersGroup
    {

        $group = $this->groupRepo->getObjectById($groupId);
        if (! $group){
            throw new EntityNotFoundException('Group with id '.$groupId.' does not exist!');
        }

        $userService = new UserService($this->userRepo);
        $user = $userService->getUser($userId);

        if(! $this->capabilityGroupAdminService->isAssignUserToGroupCapability($authorId, $groupId)){
            throw new AuthenticationException("This user" . $authorId . " does not have a capability to add user to group " . $groupId);
        }


        if ($this->groupUserRepo->isUserExistInGroup($user->getId(), $groupId)){
            throw new InvalidArgumentException("User " . $user->getId() . " is already exist in the group " . $groupId);
        }

        $userGroup = new UsersGroup();
        $userGroup->setUserId($user);
        $userGroup->setGroupId($group);
        $userGroup->setModifierId($authorId);
        $date = new \DateTime("2018-05-09 00:00:00");
        $userGroup->setTimeStart($date);

        $this->groupUserRepo->createObject($userGroup);
        return $userGroup;
    }


    /**
     * @param $authorId
     * @param $groupId
     * @param $userId
     * @throws EntityNotFoundException
     */
    public function removeUserFromGroup($authorId, $groupId, $userId) : void
    {

        $group = $this->groupRepo->getObjectById($groupId);
        if (! $group){
            throw new EntityNotFoundException('Group with id '.$groupId.' does not exist!');
        }

        $userService = new UserService($this->userRepo);
        $user = $userService->getUser($userId);

        if(! $this->capabilityGroupAdminService->isRemoveUserFromGroupCapability($authorId, $groupId)){
            throw new AuthenticationException("This user" . $authorId . " does not have a capability to add user to group " . $groupId);
        }


        if (! $this->groupUserRepo->isUserExistInGroup($user->getId(), $groupId)){
            throw new InvalidArgumentException("User " . $user->getId() . " does not exist in the group " . $groupId);
        }


        $userGroup = $this->groupUserRepo->getUserGroupByUserIdGroupId($group->getId(), $user->getId());
        $this->groupUserRepo->removeObject($userGroup);
    }



}
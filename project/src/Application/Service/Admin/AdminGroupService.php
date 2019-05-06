<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 6/5/19
 * Time: 1:54 AM
 */

namespace App\Application\Service\Admin;


use App\Application\Service\Authorization\CapabilitySystemAdminService;
use App\Application\Service\GroupService;
use App\Application\Service\UserService;
use App\Domain\Entity\Group\ChatGroup;
use App\Domain\Entity\Group\GroupRepoInterface;
use App\Domain\Entity\Group\UsersGroup;
use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepoInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Doctrine\ORM\EntityNotFoundException;


class AdminGroupService extends AdminService
{
    private $capabilityAdminService;
    private $groupService;

    public function __construct(UserRepoInterface $userRepoInterface, GroupService $groupService, CapabilitySystemAdminService $capabilitySystemAdminService) {
        parent::__construct($userRepoInterface);
        $this->groupService = $groupService;
        $this->capabilityAdminService = $capabilitySystemAdminService;
    }


    /**
     * @param int $adminId
     * @param string $groupName
     * @return ChatGroup
     * @throws \App\Application\Service\Admin\AuthenticationException
     */
    public function createGroupByAdmin(int $adminId, string $groupName): ChatGroup
    {
        $this->isSystemAdmin($adminId);
        return $this->groupService->createGroup($adminId, $groupName);

    }


    /**
     * @param int $adminId
     * @param string $groupdId
     * @throws \App\Application\Service\Admin\AuthenticationException
     * @throws \App\Application\Service\EntityNotFoundException
     */
    public function deleteGroupByAdmin(int $adminId, string $groupdId): void
    {
        $this->isSystemAdmin($adminId);
        $this->groupService->deleteGroup($adminId, $groupdId);
    }


    /**
     * @param int $adminId
     * @param int $groupId
     * @param int $userId
     * @return UsersGroup
     * @throws EntityNotFoundException
     * @throws \App\Application\Service\Admin\AuthenticationException
     */
    public function addUserToGroupByAdmin(int $adminId, int $groupId, int $userId): UsersGroup
    {
        $this->isSystemAdmin($adminId);
        return $this->groupService->addUserToGroup($adminId, $groupId, $userId);
    }


    /**
     * @param int $adminId
     * @param int $groupId
     * @param int $userId
     * @throws EntityNotFoundException
     * @throws \App\Application\Service\Admin\AuthenticationException
     */
    public function removeUserFromGroupByAdmin(int $adminId, int $groupId, int $userId): void
    {
        $this->isSystemAdmin($adminId);
        $this->groupService->removeUserFromGroup($adminId, $groupId, $userId);
    }




}
<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 8:03 PM
 */

namespace App\Application\Service\Admin;


use App\Application\Service\Authorization\CapabilitySystemAdminService;
use App\Application\Service\UserService;
use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepoInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


class AdminUserService extends AdminService
{
    private $capabilityAdminService;
    public function __construct(UserRepoInterface $userRepoInterface, CapabilitySystemAdminService $capabilitySystemAdminService) {
        parent::__construct($userRepoInterface);
        $this->capabilityAdminService = $capabilitySystemAdminService;
    }

    /**
     * @param int $adminId
     * @param string $userName
     * @param string $userPassword
     * @param string|null $fullName
     * @return User
     * @throws \App\Application\Service\Admin\AuthenticationException
     */
    public function createUserByAdmin(int $adminId, string $userName, string $userPassword, string $fullName = null): User
    {
        $this->isSystemAdmin($adminId);

        if (! $this->capabilityAdminService->isAddUserCapability($adminId)) {
            throw new AuthenticationException("this user " . $adminId . " doesn't have capability to add user");
        }

        return $this->addUser($userName, $userPassword, $fullName);
    }


    /**
     * @param int $adminId
     * @param int $userId
     * @throws \App\Application\Service\Admin\AuthenticationException
     * @throws \App\Application\Service\EntityNotFoundException
     */
    public function deleteUserByAdmin(int $adminId, int $userId): void
    {
        $this->isSystemAdmin($adminId);

        if (! $this->capabilityAdminService->isDeleteUserCapability($adminId)) {
            throw new AuthenticationException("this user " . $adminId . " doesn't have capability to delete user");
        }

        $this->deleteUser($userId);

    }


}
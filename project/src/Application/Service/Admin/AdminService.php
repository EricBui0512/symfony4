<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 7:17 PM
 */



namespace App\Application\Service\Admin;
use App\Application\Service\UserService;

/**
 * Class AdminService
 * @package App\Application\Service
 */
class AdminService extends UserService
{
    /**
     * @param int $userId
     * @return bool
     */
    public function isSystemAdmin(int $userId): bool
    {
        if (! $this->userRepository->isSystemAdmin($userId)) {
            throw new AuthenticationException("this user " . $userId . "is not admin");
        }
        return true;
    }

}
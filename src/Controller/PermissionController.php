<?php

namespace App\Controller;


use App\Repository\Interfaces\UserRepoInterface;

class PermissionController
{

    private static $userRepo;

    public function __construct(UserRepoInterface $userRepoInterface )
    {
        self::$userRepo = $userRepoInterface;

    }

    public static function isSystemAdmin( $userId) {
        return self::$userRepo->isSystemAdmin($userId);
    }



}
<?php

namespace App\Controller;

use App\Repository\Interfaces\AuthorizationRepoInterface;
use App\Utils\ConstantTerms;


class CapabilitySystemAdminController
{
    private static $authorizationRepo;

    public function __construct(AuthorizationRepoInterface $authorizationRepoInterface)
    {
       self::$authorizationRepo = $authorizationRepoInterface;
    }

    public static  function isAddUserCapability($userId) {
        return self::$authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::ADD_USER);

    }

    public static function isDeleteUserCapability($userId) {
        return self::$authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::DELETE_USER);
    }












}
<?php

namespace App\Controller;

use App\Controller\CapabilityAuthorizationController;
use App\Utils\ConstantTerms;


class CapabilitySystemAdminController extends CapabilityAuthorizationController
{

    public   function isAddUserCapability($userId) {
        return $this->authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::ADD_USER);

    }

    public  function isDeleteUserCapability($userId) {
        return $this->authorizationRepo->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::DELETE_USER);
    }












}
<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 10:12 PM
 */

namespace App\Application\Service\Authorization;

use App\Application\Utils\ConstantTerms;


final class CapabilitySystemAdminService extends CapabilityAuthorizationService
{

    /**
     * @param $userId
     * @return bool|bool
     */
    public   function isAddUserCapability($userId) {
        return $this->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::ADD_USER);

    }

    /**
     * @param $userId
     * @return bool|bool
     */
    public  function isDeleteUserCapability($userId) {
        return $this->hasThisCapability($userId, ConstantTerms::SYSTEM_ADMIN_CONTEXT, ConstantTerms::DELETE_USER);
    }

}
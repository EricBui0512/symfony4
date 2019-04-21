<?php
/**
 * Created by IntelliJ IDEA.
 * User: tuongbui
 * Date: 21/4/19
 * Time: 1:28 PM
 */

namespace App\Controller;

use App\Controller\UserController;

class AdminController extends UserController
{


    /**
     * @param $userId
     * @return bool
     */
    public  function isSystemAdmin( $userId) {
        return $this->userRepo->isSystemAdmin($userId);
    }


}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: tuongbui
 * Date: 21/4/19
 * Time: 1:13 PM
 */

namespace App\Controller;
use App\Repository\Interfaces\AuthorizationRepoInterface;

class CapabilityAuthorizationController
{
    protected $authorizationRepo;

    public function __construct(AuthorizationRepoInterface $authorizationRepoInterface)
    {
        $this->authorizationRepo = $authorizationRepoInterface;
    }


}
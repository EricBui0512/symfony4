<?php

namespace App\Repository\Interfaces;


interface AuthorizationRepoInterface
{
    public function hasThisCapability($userId, $contextLevelName, $capabilityName, $contextId = null);
}
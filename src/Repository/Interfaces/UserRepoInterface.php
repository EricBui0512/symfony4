<?php

namespace App\Repository\Interfaces;

interface UserRepoInterface extends  RepoInterface
{

    public function isSystemAdmin($userId);

}
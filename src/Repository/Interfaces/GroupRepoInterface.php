<?php

namespace App\Repository\Interfaces;


interface GroupRepoInterface extends RepoInterface
{

    public function isExistGroup($id);
    public function isEmptyGroup($id);

}
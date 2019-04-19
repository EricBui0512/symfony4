<?php



namespace  App\Repository\Interfaces;

interface RepoInterface
{
    public function getAllObjects();

    public function getObjectById($id);

    public function createObject($arg);

    public function removeObject($id);
/*
    public function saveObject($arg, $con);

    public function getByCondition($arg, $con);*/

}
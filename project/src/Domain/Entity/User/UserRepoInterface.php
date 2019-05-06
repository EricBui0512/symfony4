<?php

namespace App\Domain\Entity\User;
/**
 * Interface UserRepoInterface
 * @package App\Domain\Entity\User
 */
interface UserRepoInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getObjectById(int $id): ?User;

    /**
     * @param User $user
     */
    public function createObject(User $user): void;


   /**
    * @param User $user
    */
    public function removeObject(User $user):void;

//     /**
//      * @return array
//      */
//    public function findAll(): array;

    /**
     * @param $userId
     * @return bool
     */
    public function isSystemAdmin($userId): bool;

}
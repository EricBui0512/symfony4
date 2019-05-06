<?php




namespace App\Domain\Entity\Group;
use App\Domain\Entity\Group\ChatGroup;

interface GroupRepoInterface
{



    /**
     * @param \App\Domain\Entity\Group\Group $group
     */
    public function createObject(ChatGroup $group): void;



   /**
    * @param Group $group
    */
    public function removeObject(ChatGroup $group): void ;

    public function findAll(): array;

    public function isExistGroup($id);

//    /**
//     * @param $id
//     * @return bool
//     */
//    public function isEmptyGroup($id): bool;

     /**
      * @param $id
      * @return Group
      */
    public function getObjectById(int $id): ?ChatGroup ;


}
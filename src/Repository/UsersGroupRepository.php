<?php

namespace App\Repository;

use App\Entity\UsersGroup;
use App\Repository\Interfaces\UsersGroupRepoInterface;
use App\Repository\CustomizedServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersGroup[]    findAll()
 * @method UsersGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersGroupRepository extends CustomizedServiceEntityRepository implements UsersGroupRepoInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UsersGroup::class);
    }


    public function __call($method, $args) {
        return call_user_func_array ( [
            $this->entityRepo,
            $method
        ], $args );
    }



    /**
     * @param $id
     * @return UsersGroup
     */
    public function getObjectById($id){
        return $this->entityRepo->find($id);
    }


    public function createObject($data){
        $entityManager = $this->getDoctrine()->getManager();
        $usersGroup = new UsersGroup();
        $usersGroup->setGroupId($data["groupdId"]);
        $usersGroup->setUserId($data["userId"]);
        $entityManager->persist($usersGroup);

        $entityManager->flush();
        return $usersGroup->getId();
    }

    /**
     * @param $id
     * @return bool
     */
    public function removeObject($id){
        $entityManager = $this->getDoctrine()->getManager();
        $usersGroup = $this->entityRepo->find($id);
        $entityManager->remove($usersGroup);
        $entityManager->flush();
        return true;
    }


    /**
     * @param $userId
     * @param $groupId
     * @return bool
     */
    public function isUserExistInGroup($userId, $groupId) {
        $userInGroup = $this->entityRepo->findOneBy(
            ['user_id' => $userId],
            ['group_id' => $groupId]);

        return ($userInGroup == null) ? true : false;
    }


    public function removeUserGroupById($groupId, $userId) {
        $entityManager = $this->getDoctrine()->getManager();
        $userInGroups = $this->entityRepo->findBy(
            ['user_id' => $userId],
            ['group_id' => $groupId]);
        foreach ($userInGroups as $userInGroup) {
            $entityManager->remove($userInGroup);
        }
        $entityManager->flush();
        return true;

    }

}

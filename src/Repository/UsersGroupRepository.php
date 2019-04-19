<?php

namespace App\Repository;

use App\Entity\UsersGroup;
use App\Repository\Interfaces\UsersGroupRepoInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersGroup[]    findAll()
 * @method UsersGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersGroupRepository extends ServiceEntityRepository implements UsersGroupRepoInterface
{
    private $group;
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UsersGroup::class);
    }


    public function __call($method, $args) {
        return call_user_func_array ( [
            $this->group,
            $method
        ], $args );
    }

    /**
     * @return UsersGroup[]
     */
    public function getAllObjects(){
        $entityManager = $this->getDoctrine()->getManager();
        $usersGroup = $entityManager->getRepository('App:UsersGroup')->findAll();
        return $usersGroup;
    }

    /**
     * @param $id
     * @return UsersGroup
     */
    public function getObjectById($id){
        $entityManager = $this->getDoctrine()->getManager();
        $usersGroup = $entityManager->getRepository('App:UsersGroup')->find($id);
        return $usersGroup;
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
        $usersGroup = $entityManager->getRepository('App:UsersGroup')->find($id);
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
        $entityManager = $this->getDoctrine()->getManager();
        $userInGroup = $entityManager->getRepository('App:UserGroup')->findOneBy(
            ['user_id' => $userId],
            ['group_id' => $groupId]);

        if($userInGroup == null){
            return false;
        }
        return true;
    }


    public function removeUserGroupById($groupId, $userId) {
        $entityManager = $this->getDoctrine()->getManager();
        $userInGroups = $entityManager->getRepository('App:UserGroup')->findBy(
            ['user_id' => $userId],
            ['group_id' => $groupId]);
        foreach ($userInGroups as $userInGroup) {
            $entityManager->remove($userInGroup);
        }
        $entityManager->flush();
        return true;

    }






    // /**
    //  * @return UsersGroup[] Returns an array of UsersGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersGroup
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

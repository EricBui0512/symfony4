<?php

namespace App\Repository;

use App\Entity\User;
use App\Repository\Interfaces\UserRepoInterface;
use App\Utils\ConstantTerms;

use App\Repository\CustomizedServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends CustomizedServiceEntityRepository implements UserRepoInterface
{


    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }


    public function __call($method, $args) {
        return call_user_func_array ( [
            $this->entityRepo,
            $method
        ], $args );
    }


    /**
     * @param $data
     * @return int|null
     */
    public function createObject($data) {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setFullname($data["fullName"]);
        $user->setUsername($data["userName"]);

        $user->setPasswordHash($data["hash"]);
        $user->setPasswordSalt($data["salt"]);

        $user->setTimeModified(1232434);
        $entityManager->persist($user);

        $entityManager->flush();
        return $user->getId();
    }

    /**
     * @param $id
     * @return User return User object
     */
    public function getObjectById($id)
    {
        return $this->entityRepo->find($id);
    }




   public function removeObject($id){
       $entityManager = $this->getDoctrine()->getManager();
       $user = $this->entityRepo->find($id);
       $entityManager->remove($user);
       $entityManager->flush();
       return true;
   }


    /**
     * @param $userId
     * @return bool
     */
   public function isSystemAdmin($userId) {

       $entityManager = $this->getDoctrine()->getManager();
       $user = $entityManager->getRepository('App:User')->find($userId);
       $roleAssigments = $user->getRoleAssignments();


       foreach ($roleAssigments as $roleAssigment) {
           $sql ="SELECT *
            FROM CONTEXT_LEVELS As CL 
            JOIN CONTEXT AS C 
            ON CL.id == C.context_level_id 
            AND c.id == ". $roleAssigment->getContextId() . " 
            AND CL.Name == " . ConstantTerms::SYSTEM_ADMIN_CONTEXT;

           $stmt = $entityManager->getConnection()->prepare($sql);
           $stmt->execute();
           $results = $stmt->fetchAll();
           if (count($results) > 0) {
               return true;
           }
       }
       return false;
   }





/*
    public function saveObject($arg, $con);

    public function getByCondition($arg, $con);*/

}

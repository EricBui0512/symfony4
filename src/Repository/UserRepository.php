<?php

namespace App\Repository;

use App\Entity\User;
use App\Repository\Interfaces\UserRepoInterface;
use App\Utils\ConstantTerms;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepoInterface
{
    private $users;

    public function __construct(RegistryInterface $registry)
    {
        $this->users = User::class;
        parent::__construct($registry, $this->users);
    }


    public function __call($method, $args) {
        return call_user_func_array ( [
            $this->users,
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
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('App:User')->find($id);
        return $user;
    }


    /**
     * @return User[] return array of user object
     */
   public function getAllObjects() {
       $entityManager = $this->getDoctrine()->getManager();
       $users = $entityManager->getRepository('App:User')->findAll();
       return $users;
   }


   public function removeObject($id){
       $entityManager = $this->getDoctrine()->getManager();
       $user = $entityManager->getRepository('App:User')->find($id);
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


    // /**
    //  * @return User[] Returns an array of User objects
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
    public function findOneBySomeField($value): ?User
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

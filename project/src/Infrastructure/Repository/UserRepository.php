<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepoInterface;
use App\Application\Utils\ConstantTerms;

use Doctrine\ORM\EntityManagerInterface;


/**
 *
 * Class UserRepository
 * @package App\Infrastructure\Repository
 */
class UserRepository implements UserRepoInterface
{


    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(User::class);
    }


    /**
     * @param User $user
     */
    public function createObject(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }







    /**
     * @param User $user
     */
   public function removeObject(User $user): void
   {

       $this->entityManager->remove($user);
       $this->entityManager->flush();
   }


    /**
     * @param $userId
     * @return bool
     */
   public function isSystemAdmin($userId): bool
    {

       $user = $this->objectRepository->find($userId);

       $roleAssigments = $user->getRoleAssignments();


       foreach ($roleAssigments as $roleAssigment) {


           $sql ="SELECT *
            FROM context_levels As CL
            JOIN context AS C
            ON CL.id = C.context_level_id_id
            AND C.id = '". $roleAssigment->getContextId()->getId() . "'
            AND CL.Name = '" . ConstantTerms::SYSTEM_ADMIN_CONTEXT."'";

           $stmt = $this->entityManager->getConnection()->prepare($sql);
           $stmt->execute();
           $results = $stmt->fetchAll();
           if (count($results) > 0) {
               return true;
           }
       }
       return false;
   }


    /**
     * @param int $id
     */
    public function getObjectById(int $id): ?User
    {
        return $this->objectRepository->find($id);
    }





/*
    public function saveObject($arg, $con);

    public function getByCondition($arg, $con);*/

}

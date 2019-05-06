<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 7:29 PM
 */

namespace App\Application\Service;

use App\Domain\Entity\User\User;
use App\Domain\Entity\User\UserRepoInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class UserService
 * @package App\Application\Service
 */
class UserService
{
    /**
     * @var UserRepoInterface
     */
    protected $userRepository;


    /**
     * @param UserRepoInterface $userRepoInterface
     */
    public function __construct(UserRepoInterface $userRepoInterface) {
        $this->userRepository = $userRepoInterface;
    }





    /**
     * @param int $userId
     * @return User
     * @throws EntityNotFoundException
     */
    public function getUser(int $userId): User
    {
        $user = $this->userRepository->getObjectById($userId);
        if (!$user) {
            throw new EntityNotFoundException("User with id" . $userId . "does not exist !");
        }
        return $user;
    }


    /**
     * @param string $userName
     * @param string $password
     * @param string|null $fullName
     * @return User
     */
    public function addUser(string $userName, string $password, string $fullName=null ): User
    {
        $user = new User();
        $user->setUsername($userName);
        $user->setFullname($fullName);
        $password_salt = uniqid ( mt_rand (), true );
        $password_hash =  hash('sha256',$password_salt .$password . $password_salt);
        $user->setPasswordSalt($password_hash);
        $user->setPasswordHash($password_hash);
        $date = new \DateTime();
        $user->setTimeModified($date);
        $this->userRepository->createObject($user);
        return $user;
    }


    /**
     * @param int $userId
     * @throws EntityNotFoundException
     */
    public function deleteUser(int $userId):void
    {
        $user = $this->userRepository->getObjectById($userId);
        if (!$user) {
            throw new EntityNotFoundException("User with id" . $userId . " does not exist !");
        }
        $this->userRepository->removeObject($user);
    }








}
<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Repository\Interfaces\UserRepoInterface;

class UserController extends AbstractController
{

    protected $userRepo;

    public function __construct(UserRepoInterface $userRepoInterface )
    {
        $this->userRepo = $userRepoInterface;
    }


    public function createUser($data) {
        $data["salt"] = uniqid ( mt_rand (), true );
        $data["hash"] = hash('sha256',$data["salt"] . data['password'] . $data["salt"]);
        return $this->userRepo->createObject($data);
    }


    public function deleteUser($userId){
        if (! $this->userRepo->getObjectById($userId)){
            return false;
        }
        return $this->userRepo->removeObject($userId);
    }

}
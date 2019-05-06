<?php

/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 6/5/19
 * Time: 9:21 PM
 */


namespace App\Infrastructure\Http\RestApi\Controller;

use App\Application\Service\UserService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class UserController extends FOSRestController
{

    private $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

    }


    /**
     *
     * @Rest\Get("/users/{userId}")
     * @param int $userId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getUserByRequest(int $userId): View
    {
        $user = $this->userService->getUser($userId);

        return View::create($user, Response::HTTP_OK);
    }

}
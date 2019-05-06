<?php

namespace App\Infrastructure\Http\RestApi\Controller\Admin;

use App\Application\Service\Admin\AdminUserService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminUserController
 * @package App\Infrastructure\Http\RestApi\Controller\Admin
 */
class AdminUserController extends AdminController
{

    /**
     * @param AdminService $adminService
     */
    public function __construct(AdminUserService $adminUserService) {
        $this->adminService = $adminUserService;
    }



    /**
     * @Rest\Post("/admin/users")
     * @param Request $request
     * @return View
     */
    public function createUserByAdmin(Request $request) :View
    {

        $adminId = $request->request->get('userId');
        $userName = $request->request->get('userName');
        $password = $request->request->get('password');
        $fullName = $request->request->get('fullName');

        $newUser = $this->adminService->createUserByAdmin($adminId, $userName, $password, $fullName);

        return View::create($newUser, Response::HTTP_CREATED);

    }

    /**
     *
     * Removes the Article resource
     * @Rest\Delete("/admin/users/{adminId}/{userId}")
     * @param Request $request
     * @param int $userId
     * @return View
     */
    public function deleteUserByAdmin(int $adminId, int $userId): View
    {
        //$admin = $request->request->get("userId");
        $this->adminService->deleteUserByAdmin($adminId, $userId);

        return View::create([], Response::HTTP_NO_CONTENT);
    }








    /**
     * find hello
     * @Rest\Get("/hello")
     * @param Request $request
     * @return View
     */
    public function hello(Request $request) :View
    {
        $someVar = "hello";

        $someVar .= " xdebug";

        return View::create($someVar, Response::HTTP_OK);
    }






}
<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 6/5/19
 * Time: 1:53 AM
 */

namespace App\Infrastructure\Http\RestApi\Controller\Admin;

use App\Application\Service\Admin\AdminGroupService;
use App\Application\Service\Admin\AdminUserService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Infrastructure\Http\RestApi\Controller\Admin\AdminController;

class AdminGroupController extends AdminController
{
    /**
     * @param AdminService $adminService
     */
    public function __construct(AdminGroupService $adminGroupService) {
        $this->adminService = $adminGroupService;
    }

    /**
     * @Rest\Post("/admin/groups")
     * @param Request $request
     * @return View
     */
    public function createGroupByAdmin(Request $request): View
    {
        $adminId = $request->request->get('userId');
        $groupName = $request->request->get('groupName');
        $newGroup = $this->adminService->createGroupByAdmin($adminId, $groupName);

        return View::create($newGroup, Response::HTTP_CREATED);
    }


    /**
     * @Rest\Delete("/admin/groups/{adminId}/{groupId}")
     * @param int $adminId
     * @param int $groupId
     * @return View
     */
    public function deleteGroupByAdmin(int $adminId, int $groupId): View
    {
        $this->adminService->deleteGroupByAdmin($adminId, $groupId);
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Add a user to group by groupId
     * @Rest\Put("/admin/groups/{adminId}/{groupId}")
     * @param int $groupId
     * @param Request $request
     * @return View
     */
    public function addUserToGroupByAdmin(int $adminId, int $groupId, Request $request): View
    {
        $userId = $request->request->get("userId");
        $userGroup = $this->adminService->addUserToGroupByAdmin($adminId, $groupId, $userId);
        return View::create($userGroup->getId(), Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/admin/groups/{adminId}/{groupId}/{userId}")
     * @param int $adminId
     * @param int $groupId
     * @param $userId
     * @return View
     */
    public function removeUserFromGroupByAdmin(int $adminId, int $groupId, $userId): View
    {
        $this->adminService->removeUserFromGroupByAdmin($adminId, $groupId, $userId);
        return View::create([], Response::HTTP_NO_CONTENT);
    }





}
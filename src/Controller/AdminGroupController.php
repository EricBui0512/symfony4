<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\Interfaces\UserRepoInterface;
use Symfony\Flex\Response;

class AdminGroupController extends UserController
{

    /**
     * @Route("/createGroup", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createGroupByAdmin(Request $request) {
        $adminId = $request->request->get('userId');
        if (! PermissionController::isSystemAdmin($adminId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        }
        $data = array();
        $data['name'] = $request->request->get('groupName');

        $groupController = new GroupController();
        $result = $groupController->createGroup($data);
        if(!$result) {
            return new JsonResponse(null, JsonResponse::HTTP_EXPECTATION_FAILED);
        }
        return new JsonResponse(['createdGroupId' => $result], JsonResponse::HTTP_CREATED);
    }


    /**
     * @Route("/addUsersToGroup", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addUsersToGroupByAdmin(Request $request){
        $adminId = $request->request->get('userId');
        if (! PermissionController::isSystemAdmin($adminId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        }

        $userIds = $request->request->get("userIds");
        $groupId = $request->request->get('groupId');
        $groupController = new GroupController();
        $result = $groupController->addUserToGroup($adminId, $groupId, $userIds);
        if(!$result) {
            return new JsonResponse(null, JsonResponse::HTTP_EXPECTATION_FAILED);
        }
        return new JsonResponse(null, JsonResponse::HTTP_CREATED);
    }


    /**
     * @Route("/deleteUserFromGroup", methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteUserFromGroup(Request $request){
        $adminId = $request->request->get('userId');
        if (! PermissionController::isSystemAdmin($adminId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        }

        $userIds = $request->request->get("userIds");
        $groupId = $request->request->get('groupId');
        $groupController = new GroupController();
        $result = $groupController->removeUserFromGroup($adminId, $groupId, $userIds);
        if(! $result) {
            return new JsonResponse(null, JsonResponse::HTTP_EXPECTATION_FAILED);
        }
        return new JsonResponse(null, JsonResponse::HTTP_OK);

    }


    /**
     * @Route("/deleteGroup", methods={"DELETE"})
     * @param Request $request
     * @param int $groupId
     * @return JsonResponse
     */
    public function deleteGroupByAdmin(Request $request, int $groupId) {
        $adminId = $request->request->get('userId');
        if (! PermissionController::isSystemAdmin($adminId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        }

        $groupController = new GroupController();
        $result = $groupController->deleteGroup($adminId, $groupId);
        if(! $result) {
            return new JsonResponse(null, JsonResponse::HTTP_EXPECTATION_FAILED);
        }
        return new JsonResponse(null, JsonResponse::HTTP_OK);
    }
}
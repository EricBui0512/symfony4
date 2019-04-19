<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\Interfaces\UserRepoInterface;
use Symfony\Flex\Response;


class AdminUserController extends UserController
{


    /**
     * @Route("/createUser", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createUserByAdmin(Request $request) {

        $userId = $request->request->get('userId');
        if (! PermissionController::isSystemAdmin($userId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        };

        if (! CapabilitySystemAdminController::isAddUserCapability($userId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        }
        $data = $request->request->get('data');
        $userId = $this->createUser($data);
        if ($userId == null) {
            return new JsonResponse(null, JsonResponse::HTTP_EXPECTATION_FAILED);
        }
        return new JsonResponse(['createdUserId' => $userId], JsonResponse::HTTP_CREATED);
    }



    /**
     * @Route("/deleteUser", methods={"DELETE"},requirements={"Id"="\d+"})
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function deleteUserByAdmin(Request $request, int $id){
        $adminId = $request->request->get('userId');
        if (! PermissionController::isSystemAdmin($adminId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        };

        if (! CapabilitySystemAdminController::isDeleteUserCapability($adminId)) {
            return new JsonResponse(null, JsonResponse::HTTP_UNAUTHORIZED);
        }
        $result = $this->deleteUser($id);
        if (! $result){
            return new JsonResponse(null, JsonResponse::HTTP_EXPECTATION_FAILED);
        }
        return new JsonResponse(null, JsonResponse::HTTP_OK);

    }







}
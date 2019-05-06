<?php
/**
 * Created by IntelliJ IDEA.
 * User: tuongbui
 * Date: 21/4/19
 * Time: 1:28 PM
 */

namespace App\Infrastructure\Http\RestApi\Controller\Admin;

use FOS\RestBundle\Controller\FOSRestController;
use App\Application\Service\Admin\AdminService;

class AdminController extends FOSRestController
{

    protected $adminService;

    /**
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService) {
        $this->adminService = $adminService;
    }




}
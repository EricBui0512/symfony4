<?php

namespace App\Application\Utils;


class ConstantTerms
{

    /// context level
    const SYSTEM_ADMIN_CONTEXT = "SYSTEM";
    const GROUP_CONTEXT = "GROUP";


    /// capabilities
    const ADD_USER = "ADDUSER";
    const DELETE_USER = "DELETEUSER";
    const ASSIGN_USER_IN_GROUP = "ADDUSERTOGROUP";
    const REMOVE_USER_FROM_GROUP = "REMOVEUSERFROMGROUP";
    const CREATE_GROUP = "CREATEGROUP";
    const DELETE_GROUP = "DELETEGROUP";

}
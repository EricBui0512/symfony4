<?php

namespace App\Utils;


class ConstantTerms
{

    /// context level
    const SYSTEM_ADMIN_CONTEXT = "System";
    const GROUP_CONTEXT = "Group";


    /// capabilities
    const ADD_USER = "addUser";
    const DELETE_USER = "deleteUser";
    const ASSIGN_USER_IN_GROUP = "assignUserInGroup";
    const REMOVE_USER_FROM_GROUP = "removeUserFromGroup";
    const CREATE_GROUP = "createGroup";
    const DELETE_GROUP = "deleteGroup";

}
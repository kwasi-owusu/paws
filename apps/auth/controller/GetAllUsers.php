<?php

class GetAllUsers
{
    static public function doAllUsers(){
        $merchant_ID     = $_SESSION['merchant_ID'];
        $myRole = $_SESSION['user_type'];

        require_once('../model/AllUsersModel.php');

        $allUsers    = AllUsersModel::allUsers($merchant_ID, $myRole);

        return $allUsers;
    }
}
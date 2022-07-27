<?php

require_once '../../../../model/connection.php';
class FetchAllUsersForModalMDL
{
    static public function selectAllUser(){
        $stmt = Connection::connect()->prepare("SELECT * FROM users_tbl WHERE userRole = 13");
        $stmt->bindParam('ud', $user_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
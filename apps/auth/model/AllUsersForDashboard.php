<?php

require_once '../../model/connection.php';
class AllUsersForDashboard
{
    static public function getActiveUsers(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM users_tbl WHERE userStatus = 1");
        $stmt->execute();

        return $stmt;
    }
}
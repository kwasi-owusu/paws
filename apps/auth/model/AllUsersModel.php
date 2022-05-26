<?php

require_once '../../template/statics/conn/connection.php';
class AllUsersModel
{
    //select all user
    static public function allUsers($merchant_ID, $myRole){

        if($myRole == 1){
            $stmt = Connection::connect()->prepare("SELECT users.*, user_roles.*
        FROM users
        INNER JOIN user_roles ON users.userRole = user_roles.role_ID 
        ORDER BY users.firstName ASC");
        $stmt->execute();

        return $stmt;
        }

        elseif($myRole == 2){
        $stmt = Connection::connect()->prepare("SELECT users.*, user_roles.*
        FROM users
        INNER JOIN user_roles ON users.userRole = user_roles.role_ID 
        WHERE users.merchant_ID = :md
        ORDER BY users.firstName ASC");
        $stmt->bindParam('md', $merchant_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
        }

        elseif($myRole == 8){
        
        $stmt = Connection::connect()->prepare("SELECT users.*, user_roles.*
        FROM users
        INNER JOIN user_roles ON users.userRole = user_roles.role_ID 
        WHERE users.merchant_ID = :md
        AND users.userRole != 2
        ORDER BY users.firstName ASC");
        $stmt->bindParam('md', $merchant_ID, PDO::PARAM_STR);
        $stmt->execute();
            
        }
    }
}
<?php

require_once '../../template/statics/conn/connection.php';
class GetMyAccount
{
    //select this user
    static public function selectMyAccount($user_ID){
        $stmt = Connection::connect()->prepare("SELECT * FROM users WHERE user_ID = :ud LIMIT 1");
        $stmt->bindParam('ud', $user_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
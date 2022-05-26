<?php

require_once '../../template/statics/conn/connection.php';
class CheckUserEmail
{
    static public function checkUser($tbl, $getEmail){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE userEmail = :em LIMIT 1");
        $stmt->bindParam('em', $getEmail, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
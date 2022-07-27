<?php
require_once '../../template/statics/conn/connection.php';

class LoginUserModel{
    static public function MdlShowUsers($myUserTbl, $itm, $val){

        try {

            $stmt = Connection::connect()->prepare("SELECT * FROM $myUserTbl WHERE $itm = :$itm");

            $stmt->bindParam(":" . $itm, $val, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        }
        catch (PDOException $e){
            echo "Login Failed ";
            echo $e->getMessage();
        }
    }
}

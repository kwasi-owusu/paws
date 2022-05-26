<?php
require_once '../../template/statics/conn/connection.php';

class Merchants{
    public static function allMerchants($table){
        $stmt = Connection::connect()->prepare("SELECT * FROM $table");
        $stmt->execute();

        return $stmt;
    }

    public static function thisMerchants($merchants_ID){
        $stmt = Connection::connect()->prepare("SELECT * FROM merchants WHERE merchant_ID = :md");
        $stmt->bindParam(":md",$merchants_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}

?>
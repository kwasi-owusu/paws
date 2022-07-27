<?php

require_once '../../template/statics/conn/connection.php';
class GetInventorySubCategory
{
    public static function loadSubCat($tbl, $data){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE cat_ID = :cd");
        $stmt->bindParam('cd', $data['ct'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
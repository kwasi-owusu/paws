<?php

require_once '../../model/connection.php';
class GetInventorySubCategory
{
    static public function loadSubCat($tbl, $data){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE cat_ID = :cd");
        $stmt->bindParam('cd', $data['ct'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
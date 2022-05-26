<?php

require_once '../../../../model/connection.php';
class ListBranchShops
{
    public static function loadBranchShops($tbl, $itemBranch){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE store_physical_location = :brn ORDER BY store_name ASC");
        $stmt->bindParam('brn', $itemBranch, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
<?php

require_once '../../../model/connection.php';
class FetchAllInventorySubCategory
{
    static public function getAllInventorySubCategory($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY sub_cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
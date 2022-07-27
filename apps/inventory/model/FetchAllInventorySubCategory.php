<?php

require_once '../../template/statics/conn/connection.php';
class FetchAllInventorySubCategory
{
    public static function getAllInventorySubCategory($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY sub_cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
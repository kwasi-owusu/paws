<?php

require_once '../../template/statics/conn/connection.php';
class FetchAllInventoryCategory
{
    public static function getAllInventoryCategory($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public static function checkThisInventoryCategoryName($tbl, $cat_name){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE cat_name = :cn");
        $stmt->bindParam("cn", $cat_name, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function checkThisInventorySubCategoryName($tbl, $sub_cat){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE sub_cat_name = :cn");
        $stmt->bindParam("cn", $sub_cat, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount();
    }
}
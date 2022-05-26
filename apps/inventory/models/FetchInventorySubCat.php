<?php

require_once '../../../model/connection.php';
class FetchInventorySubCat
{
    static public function loadInventorySubCat($tbl_a, $tbl_b){

        $stmt = Connection::connect()->prepare("SELECT $tbl_a.sub_cat_ID, $tbl_a.cat_ID, $tbl_a.sub_cat_name, $tbl_a.addedOn, 
        $tbl_b.cat_ID, $tbl_b.cat_name 
        FROM $tbl_a, $tbl_b
        WHERE $tbl_a.cat_ID = $tbl_b.cat_ID
        ");
        $stmt->execute();

        return $stmt;
    }
}
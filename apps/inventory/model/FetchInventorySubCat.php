<?php

require_once '../../template/statics/conn/connection.php';
class FetchInventorySubCat
{
    public static function loadInventorySubCat($tbl_a, $tbl_b){

        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, 
        $tbl_b.*
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.cat_ID = $tbl_b.cat_ID
        
        ");
        $stmt->execute();

        return $stmt;
    }
}
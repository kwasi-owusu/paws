<?php

require_once '../../../../model/connection.php';
class GetInventorySubCat
{
    static public function callInventorySubCat($tbl_a, $tbl_b, $sub_cat_ID){
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.sub_cat_ID, $tbl_a.cat_ID, $tbl_a.sub_cat_name, $tbl_b.cat_ID, $tbl_b.cat_name 
        FROM $tbl_a, $tbl_b 
        WHERE $tbl_a.sub_cat_ID = :scd
        AND $tbl_a.cat_ID = $tbl_b.cat_ID");
        $stmt->bindParam('scd', $sub_cat_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
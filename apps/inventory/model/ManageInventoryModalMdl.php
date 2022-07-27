<?php

require_once '../../../template/statics/conn/connection.php';
class ManageInventoryModalMdl
{
    public static function callInventoryDetails($storage_ID){
        $stmt   = Connection::connect()->prepare("SELECT product_storage_tbl.*, warehouse.* FROM product_storage_tbl 
        INNER JOIN warehouse ON product_storage_tbl.wh_stored = warehouse.wh_ID
        WHERE product_storage_tbl.storage_ID = :sd");
        $stmt->bindParam('sd', $storage_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function loadAllWarehouse($tbl, $tbl_b){

        $stmt   = Connection::connect()->prepare("SELECT $tbl.wh_ID, $tbl.wh_code, $tbl.wh_cat_ID, $tbl.wh_nm, $tbl.wh_physical_location, 
        $tbl.wh_square_foot, $tbl.total_rack, $tbl.non_storage_sq_ft, $tbl.total_usable_space, $tbl.wh_clear_height, $tbl.storage_capacity, 
        $tbl.total_palette_per_rack, $tbl.current_capacity, 
        $tbl.addedBy, $tbl.addedOn, $tbl_b.cat_ID, $tbl_b.cat_Code, $tbl_b.wh_stored, $tbl_b.catDesc
        FROM $tbl, $tbl_b
        WHERE $tbl.wh_cat_ID = $tbl_b.cat_ID");
        $stmt->execute();

        return $stmt;
    }

    public static function loadAllLocations($tbl){

        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY branch_name ASC");
        $stmt->execute();

        return $stmt;
    }


}
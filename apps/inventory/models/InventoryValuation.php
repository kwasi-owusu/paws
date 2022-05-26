<?php

require_once '../../../model/connection.php';
class InventoryValuation
{
    static public function valueInventory(){
        $stmt   = Connection::connect()->prepare("SELECT product_storage_tbl.storage_ID, product_storage_tbl.inventory_cat, 
            product_storage_tbl.product_name, product_storage_tbl.recieved_qty, product_storage_tbl.wh_stored, product_storage_tbl.unit_cost, 
            COUNT(product_storage_tbl.storage_ID) AS TotalInventory,  
            SUM(product_storage_tbl.recieved_qty * product_storage_tbl.unit_cost) AS totalVal, 
            inventory_cat.*
            FROM product_storage_tbl, inventory_cat 
            WHERE product_storage_tbl.inventory_cat = inventory_cat.cat_ID 
            AND product_storage_tbl.recieved_qty > 0 
            GROUP BY inventory_cat.cat_name");

        $stmt->execute();
        return $stmt;
    }


    //get wip value
    static public function wipValuation(){
        $stmt   = Connection::connect()->prepare("SELECT request_ID, COUNT(request_ID) AS cntValue, production_status, fg_unit_price, 
        fg_unit_price, SUM(expeted_yield * fg_unit_price) AS totalCost
        FROM rm_request
        WHERE production_status = 1
        ");
        $stmt->execute();

        return $stmt;
    }

    static public function thisInventoryItems($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $get_cat_ID){
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.storage_ID, $tbl_a.product_code, $tbl_a.inventory_cat, $tbl_a.inventory_sub_cat, 
        $tbl_a.product_name, $tbl_a.batch_num, $tbl_a.recieved_qty, $tbl_a.wh_stored, $tbl_a.storage_address, $tbl_a.manu_dt, $tbl_a.expiry_dt, 
        DATEDIFF(product_storage_tbl.expiry_dt, NOW()) AS days_to_expire, $tbl_a.addedOn, $tbl_a.addedBy, $tbl_b.inventory_code, $tbl_b.inventory_cat, 
        $tbl_b.invenotory_sub_cat, $tbl_b.inventory_brand, $tbl_b.total_qty, $tbl_c.cat_ID, $tbl_c.cat_name, $tbl_d.sub_cat_ID, $tbl_d.cat_ID, $tbl_d.sub_cat_name, 
        $tbl_e.wh_ID, $tbl_e.wh_nm
        FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e
        WHERE $tbl_a.inventory_cat = :ct
        AND $tbl_a.product_code = $tbl_b.inventory_code
        AND $tbl_a.inventory_cat = $tbl_c.cat_ID
        AND $tbl_a.inventory_sub_cat = $tbl_d.sub_cat_ID
        AND $tbl_a.wh_stored = $tbl_e.wh_ID
        AND $tbl_a.recieved_qty > 0
        ");

        $stmt->bindParam('ct', $get_cat_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
<?php

require_once '../../template/statics/conn/connection.php';

class GetSellableItems
{
    public static function allSellableItems($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e , $myBranch, $noDays, $userType, $me)
    {
        // $tbl_a      = 'inventory_master';
        // $tbl_b      = 'sales_stock';
        // $tbl_c      = 'inventory_cat';
        // $tbl_d      = 'sales_persons';
        // $tbl_e      = 'pos_store';
        
        if ($userType != 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_d.*, $tbl_e .*
        FROM $tbl_a 
        INNER JOIN $tbl_b ON $tbl_a.inventory_code = $tbl_b.product_code
        INNER JOIN $tbl_e ON  $tbl_b.shop_ID = $tbl_e.store_ID
        INNER JOIN $tbl_d ON $tbl_e.store_ID = $tbl_d.pos_store_ID
        WHERE $tbl_b.recieved_qty > 0
        AND $tbl_d.sales_person = :me
        ");
            $stmt->bindParam('me', $me, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt;
        } elseif ($userType == 1 || $userType == 4) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
        FROM $tbl_a 
        INNER JOIN $tbl_b ON $tbl_a.inventory_code = $tbl_b.product_code
        WHERE $tbl_b.recieved_qty > 0
        ");
            $stmt->execute();
            return $stmt;
        }
    }

    public static function branchStockLevels($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $branchName, $userType)
    {
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.storage_ID, $tbl_a.product_code, $tbl_a.inventory_cat, $tbl_a.inventory_sub_cat, 
        $tbl_a.product_name, $tbl_a.batch_num, $tbl_a.recieved_qty, $tbl_a.wh_stored, $tbl_a.storage_address, $tbl_a.manu_dt, $tbl_a.expiry_dt, 
        DATEDIFF(product_storage_tbl.expiry_dt, NOW()) AS days_to_expire, $tbl_a.addedOn, $tbl_a.addedBy, $tbl_b.inventory_code, $tbl_b.inventory_cat, 
        $tbl_b.invenotory_sub_cat, $tbl_b.inventory_brand, $tbl_b.base_uom, $tbl_b.total_qty, $tbl_c.cat_ID, $tbl_c.cat_name, $tbl_d.sub_cat_ID, 
        $tbl_d.cat_ID, $tbl_d.sub_cat_name, $tbl_e.wh_ID, $tbl_e.wh_nm
        FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e
        WHERE $tbl_a.product_code = $tbl_b.inventory_code
        AND $tbl_a.inventory_cat = $tbl_c.cat_ID
        AND $tbl_a.inventory_sub_cat = $tbl_d.sub_cat_ID
        AND $tbl_a.wh_stored = $tbl_e.wh_ID
        AND $tbl_b.sellable = 1
        AND $tbl_a.recieved_qty > 0
        AND $tbl_a.branch_owner = :brn
        ");
        $stmt->bindParam('brn', $branchName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function LoadAllSellableItems($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e)
    {
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.storage_ID, $tbl_a.product_code, $tbl_a.inventory_cat, $tbl_a.inventory_sub_cat, 
        $tbl_a.product_name, $tbl_a.batch_num, $tbl_a.recieved_qty, $tbl_a.wh_stored, $tbl_a.storage_address, $tbl_a.manu_dt, $tbl_a.expiry_dt, 
        DATEDIFF(product_storage_tbl.expiry_dt, NOW()) AS days_to_expire, $tbl_a.addedOn, $tbl_a.addedBy, $tbl_b.inventory_code, $tbl_b.inventory_cat, 
        $tbl_b.invenotory_sub_cat, $tbl_b.inventory_brand, $tbl_b.base_uom, $tbl_b.total_qty, $tbl_c.cat_ID, $tbl_c.cat_name, $tbl_d.sub_cat_ID, 
        $tbl_d.cat_ID, $tbl_d.sub_cat_name, $tbl_e.wh_ID, $tbl_e.wh_nm
        FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e
        WHERE $tbl_a.product_code = $tbl_b.inventory_code
        AND $tbl_a.inventory_cat = $tbl_c.cat_ID
        AND $tbl_a.inventory_sub_cat = $tbl_d.sub_cat_ID
        AND $tbl_a.wh_stored = $tbl_e.wh_ID
        AND $tbl_b.sellable = 1
        AND $tbl_a.recieved_qty > 0
        ");

        $stmt->execute();
        return $stmt;
    }


    public static function costThisSellableItems($tbl_a)
    {
        $stmt = Connection::connect()->prepare("SELECT *
        FROM $tbl_a
        ORDER BY product_name ASC
        ");

        $stmt->execute();

        return $stmt;
    }
}

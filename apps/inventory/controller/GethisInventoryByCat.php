<?php


class GethisInventoryByCat
{
    public static function inventoryByCat($get_cat_ID){
        $tbl_a      = 'product_storage_tbl';
        $tbl_b      = 'inventory_master';
        $tbl_c      = 'inventory_cat';
        $tbl_d      = 'inventory_sub_cat';
        $tbl_e      = 'warehouse';

        require_once '../model/InventoryValuation.php';
        $getRst     = InventoryValuation::thisInventoryItems($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $get_cat_ID);

        return $getRst;
    }
}
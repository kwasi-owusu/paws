<?php


class GetThisInventoryItemByID
{
    static public function thisInventoryItem($inventory_ID){
        $tbl_a        = 'inventory_master';
        $tbl_b        = 'inventory_cat';
        $tbl_c        = 'inventory_sub_cat';
        $tbl_d        = 'uom';
        require_once ('../../../model/inventory/CallthisInventory.php');
        $getRs      = CallthisInventory::thisInventoryItem($tbl_a, $tbl_b, $tbl_c, $tbl_d, $inventory_ID);

        return $getRs;
    }
}
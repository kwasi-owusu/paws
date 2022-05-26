<?php


class LoadInventoryCategoryByID
{
    static public function inventoryCatByID($cat_ID){
        require_once ('../../../../model/inventory/LoadInventoryCatByID.php');
        $tbl    = 'inventory_cat';
        $data   = array(
            'cd'=>$cat_ID
        );

        $getRst = LoadInventoryCatByID::callCatByID($tbl, $data);

        return $getRst;
    }

    static public function inventoryItem($inventory_ID){
        require_once ('../../../../model/inventory/LoadInventoryCatByID.php');
        $tbl    = 'sales_stock';
        $data   = array(
            'd'=>$inventory_ID
        );

        $getRst = LoadInventoryCatByID::callThisInventory($tbl, $data);

        return $getRst;
    }

    static public function fgItems($inventory_ID){
        require_once ('../../../../model/inventory/LoadInventoryCatByID.php');
        $tbl    = 'inventory_master';
        $data   = array(
            'd'=>$inventory_ID
        );

        $getRst = LoadInventoryCatByID::callThisFG($tbl, $data);

        return $getRst;
    }
}
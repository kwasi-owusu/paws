<?php


class LoadInventoryCategoryByID
{
    public static function inventoryCatByID($cat_ID){
        require_once ('../model/LoadInventoryCatByID.php');
        $tbl    = 'inventory_cat';
        $data   = array(
            'cd'=>$cat_ID
        );

        $getRst = LoadInventoryCatByID::callCatByID($tbl, $data);

        return $getRst;
    }

    public static function inventoryItem($inventory_ID){
        require_once ('../model/LoadInventoryCatByID.php');
        $tbl    = 'sales_stock';
        $data   = array(
            'd'=>$inventory_ID
        );

        $getRst = LoadInventoryCatByID::callThisInventory($tbl, $data);

        return $getRst;
    }

    public static function fgItems($inventory_ID){
        require_once ('../model/LoadInventoryCatByID.php');
        $tbl    = 'inventory_master';
        $data   = array(
            'd'=>$inventory_ID
        );

        $getRst = LoadInventoryCatByID::callThisFG($tbl, $data);

        return $getRst;
    }
}
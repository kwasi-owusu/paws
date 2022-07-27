<?php


class LoadInventoryCatForModal
{
    static public function allCategoriesForModal(){
        require_once ('../../model/GetInventoryCatForModal.php');
        $tbl = 'inventory_cat';
        $getCat = GetInventoryCatForModal::InventoryCatForModal($tbl);

        return $getCat;
    }

    static public function allSubCategoriesForModal(){
        require_once ('../../model/GetInventoryCatForModal.php');
        $tbl = 'inventory_sub_cat';
        $getCat = GetInventoryCatForModal::InventorySubCatForModal($tbl);

        return $getCat;
    }

    public static function selectUOM(){
        require_once ('../../model/GetInventoryCatForModal.php');
        $tbl    = 'uom';
        $getRst     = GetInventoryCatForModal::getAllUOM($tbl);

        return $getRst;
    }

    public static function thisInventoryItemForModal($inventory_ID){
        $tbl_a      = 'inventory_master';
        $tbl_b      = 'inventory_cat';
        $tbl_c      = 'inventory_sub_cat';
        $tbl_d      = 'uom';
        $tbl_e      = 'brands';
        require_once ('../../model/GetInventoryCatForModal.php');
        $getRs      = GetInventoryCatForModal::thisInventoryItem($tbl_a, $tbl_b, $tbl_c, $tbl_d, $inventory_ID, $tbl_e );

        return $getRs;
    }

    public static function brandForModal(){
        require_once ('../../model/GetInventoryCatForModal.php');
        $tbl    = 'brands';
        $getRst     = GetInventoryCatForModal::getAllBrandsForModal($tbl);

        return $getRst;
    }
}
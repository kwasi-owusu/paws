<?php


class LoadInventorySubCategoryByID
{
    static public function getInventorySubCategoryByID($sub_cat_ID){
        require_once ('../../../../model/inventory/GetInventorySubCat.php');
        $tbl_a    = 'inventory_sub_cat';
        $tbl_b  = 'inventory_cat';
        $getRs  = GetInventorySubCat::callInventorySubCat($tbl_a, $tbl_b, $sub_cat_ID);

        return $getRs;
    }
}
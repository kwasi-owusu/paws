<?php


class GetAllInventorySubCategories
{
    public static function allSubCategories(){
        require_once ('../model/FetchAllInventorySubCategory.php');
        $tbl = 'inventory_sub_cat';
        $getSubCat = FetchAllInventorySubCategory::getAllInventorySubCategory($tbl);

        return $getSubCat;
    }
}
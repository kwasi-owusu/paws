<?php


class GetAllInventorySubCategories
{
    static public function allSubCategories(){
        require_once ('../../../model/inventory/FetchAllInventorySubCategory.php');
        $tbl = 'inventory_sub_cat';
        $getSubCat = FetchAllInventorySubCategory::getAllInventorySubCategory($tbl);

        return $getSubCat;
    }
}
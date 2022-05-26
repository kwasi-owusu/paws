<?php


class GetAllInventoryCategories
{
    static public function allCategories(){
        require_once ('../../../model/inventory/FetchAllInventoryCategory.php');
        $tbl = 'inventory_cat';
        $getCat = FetchAllInventoryCategory::getAllInventoryCategory($tbl);

        return $getCat;
    }
}
$callClass  = new GetAllInventoryCategories();
$CallMethod = $callClass->allCategories();
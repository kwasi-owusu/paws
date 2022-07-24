<?php


class GetAllInventoryCategories
{
    public static function allCategories(){
        require_once ('../model/FetchAllInventoryCategory.php');
        $tbl = 'inventory_cat';
        $getCat = FetchAllInventoryCategory::getAllInventoryCategory($tbl);

        return $getCat;
    }
}
$callClass  = new GetAllInventoryCategories();
$CallMethod = $callClass->allCategories();
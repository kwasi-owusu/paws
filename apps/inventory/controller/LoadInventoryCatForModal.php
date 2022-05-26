<?php


class LoadInventoryCatForModal
{
    static public function allCategoriesForModal(){
        require_once ('../../../../model/inventory/GetInventoryCatForModal.php');
        $tbl = 'inventory_cat';
        $getCat = GetInventoryCatForModal::InventoryCatForModal($tbl);

        return $getCat;
    }
}
<?php


class LoadInventorySubCat
{
    static public function loadSubCat(){
        require_once ('../../../model/inventory/FetchInventorySubCat.php');
        $tbl_a    = 'inventory_sub_cat';
        $tbl_b    = 'inventory_cat';
        $rqsModel = FetchInventorySubCat::loadInventorySubCat($tbl_a, $tbl_b);

        return $rqsModel;
    }
}
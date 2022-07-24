<?php


class GetAllStockLevels
{
    public static function allStockLevels(){

        $tbl_a      = 'product_storage_tbl';
        $tbl_b      = 'inventory_master';
        $tbl_c      = 'inventory_cat';
        $tbl_d      = 'inventory_sub_cat';
        $tbl_e      = 'warehouse';

        require_once ('../model/LoadAllStockLevels.php');
        $getRst     = LoadAllStockLevels::GetAllStockLevels($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e);

        return $getRst->fetchAll();
    }

    public static function thisBranchStockLevels($branchName){

        $tbl_a      = 'product_storage_tbl';
        $tbl_b      = 'inventory_master';
        $tbl_c      = 'inventory_cat';
        $tbl_d      = 'inventory_sub_cat';
        $tbl_e      = 'warehouse';

        require_once ('../model/LoadAllStockLevels.php');
        $getRst     = LoadAllStockLevels::branchStockLevels($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $branchName);

        return $getRst->fetchAll();
    }
}
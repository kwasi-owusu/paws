<?php


class ManageInventoryModalCtr
{
    public static function getInventoryStorageDetails($storage_ID){
        require_once '../../model/ManageInventoryModalMdl.php';
        $getRst = ManageInventoryModalMdl::callInventoryDetails($storage_ID);

        return $getRst;
    }

    public static function callAllWarehouse(){
        require_once '../model/ManageInventoryModalMdl.php';
        $tbl    = 'warehouse';
        $tbl_b  = 'warehse_cat';
        $getRst = ManageInventoryModalMdl::loadAllWarehouse($tbl, $tbl_b);

        return $getRst;
    }

    public static function CTRAllAllLocations(){
        require_once '../model/ManageInventoryModalMdl.php';
        $tbl    = 'branches';
        $getRst = ManageInventoryModalMdl::loadAllLocations($tbl);

        return $getRst;
    }
}
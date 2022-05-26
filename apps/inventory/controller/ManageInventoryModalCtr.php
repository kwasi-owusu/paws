<?php


class ManageInventoryModalCtr
{
    static public function getInventoryStorageDetails($storage_ID){
        require_once '../../../../model/inventory/ManageInventoryModalMdl.php';
        $getRst = ManageInventoryModalMdl::callInventoryDetails($storage_ID);

        return $getRst;
    }

    static public function callAllWarehouse(){
        require_once '../../../../model/inventory/ManageInventoryModalMdl.php';
        $tbl    = 'warehouse';
        $tbl_b  = 'warehse_cat';
        $getRst = ManageInventoryModalMdl::loadAllWarehouse($tbl, $tbl_b);

        return $getRst;
    }

    static public function CTRAllAllLocations(){
        require_once '../../../../model/inventory/ManageInventoryModalMdl.php';
        $tbl    = 'branches';
        $getRst = ManageInventoryModalMdl::loadAllLocations($tbl);

        return $getRst;
    }
}
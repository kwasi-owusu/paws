<?php


class GetInventoryValueCtr
{
    static public function totalInvVal(){
        $tbl    = 'product_storage_tbl';
        require_once '../../model/inventory/GetInventoryValueMdl.php';
        $getRst     = GetInventoryValueMdl::totalInventoryValue($tbl);

        return $getRst;
    }

    static public function totalScrapVal(){
        $tbl    = 'scrap_inventory_tbl';
        require_once '../../model/inventory/GetInventoryValueMdl.php';
        $getRst     = GetInventoryValueMdl::totalScrapValue($tbl);

        return $getRst;
    }
}
<?php


class GetInventoryValueCtr
{
    public static function totalInvVal(){
        $tbl    = 'product_storage_tbl';
        require_once '../model/GetInventoryValueMdl.php';
        $getRst     = GetInventoryValueMdl::totalInventoryValue($tbl);

        return $getRst;
    }

    public static function totalScrapVal(){
        $tbl    = 'scrap_inventory_tbl';
        require_once '../../model/inventory/GetInventoryValueMdl.php';
        $getRst     = GetInventoryValueMdl::totalScrapValue($tbl);

        return $getRst;
    }
}
<?php


class GetAllInventoryMaster
{
    static public function loadInventoryMaster()
    {
        require_once('../model/FetchAllInventoryMaster.php');
        $tbl        = 'inventory_master';
        $getRst     = FetchAllInventoryMaster::allInventoryMaster($tbl);

        return $getRst;
    }

    static public function loadPendingInventoryMaster()
    {
        require_once('../model/FetchAllInventoryMaster.php');
        $tbl        = 'inventory_master';
        $getRst     = FetchAllInventoryMaster::allPendingInventoryMaster($tbl);

        return $getRst;
    }
}
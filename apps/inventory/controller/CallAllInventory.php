<?php


class CallAllInventory
{
    static public function loadAllInventory(){
        require_once ('../../model/inventory/GetAllInventory.php');
        $tbl        = 'inventory_master';
        $getRst     = GetAllInventory::loadAllInventory($tbl);

        return $getRst;
    }
}
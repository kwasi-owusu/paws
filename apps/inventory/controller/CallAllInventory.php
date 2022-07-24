<?php


class CallAllInventory
{
    public static function loadAllInventory(){
        require_once ('../model/GetAllInventory.php');
        $tbl        = 'inventory_master';
        $getRst     = GetAllInventory::loadAllInventory($tbl);

        return $getRst;
    }
}
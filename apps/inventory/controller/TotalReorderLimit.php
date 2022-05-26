<?php


class TotalReorderLimit
{
    static public function getReorderRule(){
        require_once('../../model/inventory/ReorderLimit.php');
        $tbl    = 'inventory_master';
        $getRst = ReorderLimit::getReorderRule($tbl);

        return $getRst;
    }
}
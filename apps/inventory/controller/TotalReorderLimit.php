<?php


class TotalReorderLimit
{
    public static function getReorderRule(){
        require_once('../model/ReorderLimit.php');
        $tbl    = 'inventory_master';
        $getRst = ReorderLimit::getReorderRule($tbl);

        return $getRst;
    }
}
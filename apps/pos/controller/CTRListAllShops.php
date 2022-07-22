<?php


class CTRListAllShops
{
    public static function callAllStores(){
        require_once ('../model/ListAllShops.php');
        $tbl        = 'pos_store';
        $getRst     = ListAllShops::loadAllShops($tbl);

        return $getRst;
    }
}
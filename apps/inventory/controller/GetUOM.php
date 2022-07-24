<?php


class GetUOM
{
    public static function selectUOM(){
        require_once ('../model/FetchUOM.php');
        $tbl    = 'uom';
        $getRst     = FetchUOM::getAllUOM($tbl);

        return $getRst;
    }
}
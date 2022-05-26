<?php


class GetUOM
{
    static public function selectUOM(){
        require_once ('../../../model/inventory/FetchUOM.php');
        $tbl    = 'uom';
        $getRst     = FetchUOM::getAllUOM($tbl);

        return $getRst;
    }
}
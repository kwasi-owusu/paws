<?php


class GetThisUOMController
{
    static public function thisUOM($uomID){
        require_once('../../../model/settings/FetchAllUOM.php');
        $tbl    = 'uom';
        $getRst = FetchAllUOM:: callThisUOM($tbl, $uomID);

        return $getRst;
    }
}
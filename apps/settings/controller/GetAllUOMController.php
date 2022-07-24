<?php


class GetAllUOMController
{
    static public function allUOM(){
        require_once('../../settings/model/FetchAllUOM.php');
        //require_once '../model/CheckEmailsMdl.php';

        $tbl    = 'uom';
        $getRst = FetchAllUOM:: callAllUOM($tbl);

        return $getRst;
    }
}
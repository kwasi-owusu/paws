<?php


class CTRGetAllSalesPerson
{
    static public function GetAllSalesPersons(){
        require_once ('../../../../model/pos/MDLGetAllSalesPersons.php');
        $tbl    = 'users_tbl';
        $getRst = MDLGetAllSalesPersons::AllSalesPersons($tbl);

        return $getRst;

    }
}
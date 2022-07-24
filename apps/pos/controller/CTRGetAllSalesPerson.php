<?php


class CTRGetAllSalesPerson
{
    static public function GetAllSalesPersons(){
        require_once ('../../model/MDLGetAllSalesPersons.php');
        $tbl    = 'users';
        $getRst = MDLGetAllSalesPersons::AllSalesPersons($tbl);

        return $getRst;

    }
}
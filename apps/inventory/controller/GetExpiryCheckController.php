<?php

require_once('../../model/inventory/ExpiryCheckMonth.php');
class GetExpiryCheckController
{
    static public function expiryCheckMonthController(){
        $tbl        = 'expirysetting';
        $getRst     = ExpiryCheckMonth::getMonthsToCheck($tbl);

        return $getRst;
    }

    static public function checkExpiryController($no_of_month){
        $tbl    = 'product_storage_tbl';

        $getRst     = ExpiryCheckMonth::checkExpiry($no_of_month, $tbl);

        return $getRst;
    }
}
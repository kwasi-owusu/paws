<?php

require_once('../model/ExpiryCheckMonth.php');
class GetExpiryCheckController
{
    public static function expiryCheckMonthController(){
        $tbl        = 'expirysetting';
        $getRst     = ExpiryCheckMonth::getMonthsToCheck($tbl);

        return $getRst;
    }

    public static function checkExpiryController($no_of_month){
        $tbl    = 'product_storage_tbl';

        $getRst     = ExpiryCheckMonth::checkExpiry($no_of_month, $tbl);

        return $getRst;
    }
}
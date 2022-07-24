<?php

require_once('../model/ExpiryCheckReportMdl.php');
class ExpiryCheckReport
{
    public static function expiryCheckMonthReportController(){
        $tbl        = 'expirysetting';
        $getRst     = ExpiryCheckReportMdl::getMonthsToCheckReport($tbl);

        return $getRst;
    }

    public static function checkExpiryReportController($no_of_month){
        $tbl    = 'product_storage_tbl';
        $tbl_b  = 'inventory_cat';
        $tbl_c  = 'inventory_sub_cat';

        $getRst     = ExpiryCheckReportMdl::checkExpiryReport($no_of_month, $tbl, $tbl_b, $tbl_c);

        return $getRst;
    }
}
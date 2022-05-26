<?php

require_once('../../../model/inventory/ExpiryCheckReportMdl.php');
class ExpiryCheckReport
{
    static public function expiryCheckMonthReportController(){
        $tbl        = 'expirysetting';
        $getRst     = ExpiryCheckReportMdl::getMonthsToCheckReport($tbl);

        return $getRst;
    }

    static public function checkExpiryReportController($no_of_month){
        $tbl    = 'product_storage_tbl';
        $tbl_b  = 'inventory_cat';
        $tbl_c  = 'inventory_sub_cat';

        $getRst     = ExpiryCheckReportMdl::checkExpiryReport($no_of_month, $tbl, $tbl_b, $tbl_c);

        return $getRst;
    }
}
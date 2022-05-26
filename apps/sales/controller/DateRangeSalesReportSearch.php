<?php


class DateRangeSalesReportSearch
{
    static public function doDateRangeSalesInvoice($branch, $start_date, $end_date){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        require_once('../../../model/sales/DateRangeSalesReportSearchMDL.php');
        $allUsers    = DateRangeSalesReportSearchMDL::loadApprovedSalesOrderWithDateRange($branch, $start_date, $end_date, $tbl_a, $tbl_b, $tbl_c);

        return $allUsers;
    }
}
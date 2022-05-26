<?php


class DateRangePurchasesReportSearch
{
    static public function printThisPO($branch, $start_date, $end_date){
        require_once '../../../model/purchases/DateRangePurchasesReportSearchMDL.php';
        $getRst     = DateRangePurchasesReportSearchMDL::printThisPOWithDateRange($branch, $start_date, $end_date);

        return $getRst;
    }
}
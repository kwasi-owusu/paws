<?php


class DateRangePOSSearch
{
    static public function totalRangeSum($start_date, $end_date){
        require_once('../../../model/sales/GetPOSRangeReport.php');
        $getRst = GetPOSRangeReport::rangeSumTotal($start_date, $end_date);

        return $getRst;
    }


    static public function totalRange($start_date, $end_date){
        require_once('../../../model/sales/GetPOSRangeReport.php');
        $getRst = GetPOSRangeReport::dateRangeReport($start_date, $end_date);

        return $getRst;
    }
}
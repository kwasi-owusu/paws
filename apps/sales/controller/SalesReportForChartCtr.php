<?php


class SalesReportForChartCtr
{
    static public function salesChartReport(){
        require_once('../../model/sales/SalesReportForChartMDL.php');
        $getRst     = SalesReportForChartMDL::chartReport();

        return $getRst;

    }
}
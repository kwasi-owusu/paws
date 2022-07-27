<?php

require_once('../../pos/model/GetPOSReport.php');
class CTRPOSSalesReport
{
    static public function allTimePOSReport(){
        $getRst = GetPOSReport::allTimeReport();

        return $getRst;
    }

    static public function thisMonths(){
        $getRst = GetPOSReport::thisMonthPOSSales();

        return $getRst;
    }

    static public function thisYr(){
        $getRst = GetPOSReport::thisYearPOSSales();

        return $getRst;
    }

    static public function allTimeSalesPerson($salesPerson){

        $getRst = GetPOSReport::allTimeSalesPerson($salesPerson);

        return $getRst;
    }

    static public function thisMonthSalesPerson($salesPerson){

        $getRst = GetPOSReport::thisMonthSalesPerson($salesPerson);

        return $getRst;
    }


    static public function thisYrSalesPerson($salesPerson){

        $getRst = GetPOSReport::thisYearSalesPerson($salesPerson);

        return $getRst;
    }

    static public function thisYrSalesDetails($saleID){

        $getRst = GetPOSReport::thisSpecificSalesDetails($saleID);

        return $getRst;
    }

    static public function totalThisMonth(){

        $getRst = GetPOSReport::thisMonthPSumTotal();

        return $getRst;
    }

    static public function totalThisYear(){

        $getRst = GetPOSReport::thisYearSumTotal();

        return $getRst;
    }static public function totalAllTime(){

        $getRst = GetPOSReport::AllTimeSumTotal();

        return $getRst;
    }
}
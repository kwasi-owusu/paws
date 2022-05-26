<?php

require_once('../../model/sales/GetTotalOrderForToday.php');
class TodayOrdersController
{
    static public function ordersToday(){

        $tbl        = 'sales_tbl';
        $getRst     = GetTotalOrderForToday::todayOrders($tbl);

        return      $getRst;
    }

    static public function completeOrdersToday(){
        $tbl        = 'sales_tbl';
        $tbl_b      = 'salesorderfinancial';
        $getRst     = GetTotalOrderForToday::fulfilledOrdersToday($tbl, $tbl_b);

        return      $getRst;
    }

    static public function sumSalesToday(){
        $tbl        = 'sales_tbl';
        $tbl_b      = 'salesorderfinancial';
        $getRst     = GetTotalOrderForToday::totalSalesToday($tbl, $tbl_b);

        return      $getRst;
    }

    static public function dashboardOrders(){
        $tbl_a        = 'sales_tbl';
        $tbl_b      = 'customers';
        $getRst     = GetTotalOrderForToday::todayOrdersForDashboard($tbl_a, $tbl_b);

        return      $getRst;
    }
}
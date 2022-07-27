<?php

require_once('../../sales/model/GetTotalOrderForToday.php');
class TodayOrdersController
{
    public static function ordersToday(){

        $tbl        = 'sales_tbl';
        $getRst     = GetTotalOrderForToday::todayOrders($tbl);

        return      $getRst;
    }


    public static function ordersThisMonth(){

        $tbl        = 'sales_tbl';
        $getRst     = GetTotalOrderForToday::thisMonthOrders($tbl);

        return      $getRst;
    }

    public static function completeOrdersToday(){
        $tbl        = 'sales_tbl';
        $tbl_b      = 'salesorderfinancial';
        $getRst     = GetTotalOrderForToday::fulfilledOrdersToday($tbl, $tbl_b);

        return      $getRst;
    }

    public static function sumSalesToday(){
        $tbl        = 'sales_tbl';
        $tbl_b      = 'salesorderfinancial';
        $getRst     = GetTotalOrderForToday::totalSalesToday($tbl, $tbl_b);

        return      $getRst;
    }

    public static function dashboardOrders(){
        $tbl_a        = 'sales_tbl';
        $tbl_b      = 'customers';
        $getRst     = GetTotalOrderForToday::todayOrdersForDashboard($tbl_a, $tbl_b);

        return      $getRst;
    }

    public static function dashboardOrdersThisMonth(){
        $tbl_a        = 'sales_tbl';
        $tbl_b      = 'customers';
        $getRst     = GetTotalOrderForToday::thisMOnthOrdersForDashboard($tbl_a, $tbl_b);

        return      $getRst;
    }
    
    public static function topSellingThisMonth(){
        $tbl_a      = 'pos_trans_items';
        $tbl_b      = 'inventory_master';
        $tbl_c      = 'pos_trans_financials'; 
        $tbl_d      = 'pos_trans';  
        $getRst     = GetTotalOrderForToday::topSellingItemsThisMonth($tbl_a, $tbl_b, $tbl_c, $tbl_d);

        return      $getRst;
    }
}
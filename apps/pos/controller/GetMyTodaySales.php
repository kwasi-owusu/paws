<?php

class GetMyTodaySales
{
    public static function myTodaySales(){
        $me     = $_SESSION['uid'];
        $tbl    = 'pos_trans';

        require_once('../model/GetMyTodaySalesMdl.php');
        $getRst     = GetMyTodaySalesMdl::mySalesForToday($me, $tbl);

        return $getRst;

    }

    public static function TodaySalesItems(){
        $me     = $_SESSION['uid'];
        $tbl    = 'pos_trans';
        $tbl_b  = 'pos_trans_items';
        $tbl_c  = 'pos_trans_financials';

        require_once('../model/GetMyTodaySalesMdl.php');
        $getRst     = GetMyTodaySalesMdl::SalesForTodayDetails($me, $tbl, $tbl_b, $tbl_c);

        return $getRst;

    }
}
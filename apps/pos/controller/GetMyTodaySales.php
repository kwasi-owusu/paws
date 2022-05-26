<?php

session_start();
class GetMyTodaySales
{
    static public function myTodaySales(){
        $me     = $_SESSION['uid'];
        $tbl    = 'pos_trans';

        require_once('../../../model/pos/GetMyTodaySalesMdl.php');
        $getRst     = GetMyTodaySalesMdl::mySalesForToday($me, $tbl);

        return $getRst;

    }

    static public function TodaySalesItems(){
        $me     = $_SESSION['uid'];
        $tbl    = 'pos_trans';
        $tbl_b  = 'pos_trans_items';

        require_once('../../../model/pos/GetMyTodaySalesMdl.php');
        $getRst     = GetMyTodaySalesMdl::SalesForTodayDetails($me, $tbl, $tbl_b);

        return $getRst;

    }
}
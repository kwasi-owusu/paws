<?php


class MyTodaySalesDetails
{
    static public function TodaySalesDetails(){
        $me     = $_SESSION['uid'];
        $tbl    = 'pos_trans';

        require_once('../../../../model/pos/MDLTodaySalesDetails.php');
        $getRst     = GetMyTodaySalesMdl::mySalesForToday($me, $tbl);

        return $getRst;

    }
}
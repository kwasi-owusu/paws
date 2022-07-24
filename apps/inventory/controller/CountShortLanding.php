<?php


class CountShortLanding
{
    public static function getShortLanding(){
        require_once('../model/ShortLandingCount.php');
        $tbl = 'purchase_order_items;';
        $getRst = ShortLandingCount::totalShortLanding($tbl);

        return $getRst;
    }
}
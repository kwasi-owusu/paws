<?php


class CountShortLanding
{
    static public function getShortLanding(){
        require_once('../../model/inventory/ShortLandingCount.php');
        $tbl = 'purchase_order_items;';
        $getRst = ShortLandingCount::totalShortLanding($tbl);

        return $getRst;
    }
}
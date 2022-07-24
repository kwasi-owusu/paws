<?php


class ShortLandingCtrl
{
    public static function getShortLanding(){
        require_once('../model/ShortLandingMdl.php');
        $tbl = 'purchase_order_items;';
        $getRst = ShortLandingMdl::getShortLanding();

        return $getRst;
    }
}
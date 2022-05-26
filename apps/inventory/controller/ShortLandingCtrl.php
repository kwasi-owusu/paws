<?php


class ShortLandingCtrl
{
    static public function getShortLanding(){
        require_once('../../../model/inventory/ShortLandingMdl.php');
        $tbl = 'purchase_order_items;';
        $getRst = ShortLandingMdl::getShortLanding();

        return $getRst;
    }
}
<?php


class GetThisPOItem
{
    static public function callThisPOItm($po_ID){
        require_once('../../../../model/purchases/ThisPOItems.php');

        $tbl        = 'purchase_order_items';
        $po_ID      =
        $getRst     = ThisPOItems::thisItems($tbl, $po_ID);

        return $getRst;
    }
}
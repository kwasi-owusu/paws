<?php


class PendingPurchaseOrderController
{
    static public function pendingPOs(){
        require_once('../../model/purchases/PendingPurchaseOrderModel.php');

        $tbl        = 'new_purch_oder';
        $getRst     = PendingPurchaseOrderModel::totalPendingPO($tbl);

        return      $getRst;
    }
}
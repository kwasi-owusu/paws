<?php


class PrintThisApprovedPOCtrl
{
    static public function doThisApprovedPO($po_ID){
        require_once '../../../model/purchases/PrintThisApprovedPO.php';
        $getRst     = PrintThisApprovedPO::thisApprovedPO($po_ID);

        return $getRst;

    }
}
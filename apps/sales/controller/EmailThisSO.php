<?php

session_start();
class EmailThisSO
{
    static public function thisApprovedSO($po_ID){
        require_once '../../../model/sales/EmailThisApprovedSO.php';
        $getRst     = EmailThisApprovedSO::thisApprovedSO($po_ID);

        return $getRst;

    }
}
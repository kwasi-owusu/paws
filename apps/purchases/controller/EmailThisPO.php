<?php


class EmailThisPO
{
    static public function thisApprovedPO($so_ID){
        require_once '../../../model/purchases/EmailThisApprovedPO.php';
        $getRst     = EmailThisApprovedPO::thisApprovedPO($so_ID);

        return $getRst;

    }
}
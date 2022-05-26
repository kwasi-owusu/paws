<?php


class GetPOApprovalStatus
{
    static public function poStatus($po_ID){
        require_once '../../../model/purchases/CheckPOApprovals.php';
        $getRst     = CheckPOApprovals::checkApprovalStatus($po_ID);

        return $getRst;
    }
}
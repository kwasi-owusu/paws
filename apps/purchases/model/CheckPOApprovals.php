<?php

require_once '../../../model/connection.php';
class CheckPOApprovals
{
    static public function checkApprovalStatus($po_ID){
        $stmt   = Connection::connect()->prepare("SELECT po_approvals.*, users_tbl.* FROM po_approvals
        INNER JOIN users_tbl ON po_approvals.approvalBy = users_tbl.user_ID
        WHERE po_approvals.po_ID = :pd
        ");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
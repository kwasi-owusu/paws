<?php

require_once '../../model/connection.php';
class PendingPurchaseOrderModel
{
    static public function totalPendingPO($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE approval_status = 0");
        $stmt->execute();

        return $stmt->rowCount();
    }
}
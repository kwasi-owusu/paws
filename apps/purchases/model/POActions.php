<?php

require_once '../../model/connection.php';
class POActions
{
    static public function thisPODetails($tbl, $po_ID){
        $stmt       = Connection::connect()->prepare("SELECT * FROM $tbl WHERE po_ID = :pd");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function thisPOApproval($tbl, $po_ID){
        $stmt       = Connection::connect()->prepare("SELECT * FROM $tbl WHERE po_ID = :pd AND approve_action = 1");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function myPOApproval($tbl, $po_ID, $myID){
        $stmt       = Connection::connect()->prepare("SELECT * FROM $tbl WHERE po_ID = :pd AND approvalBy = :me");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->bindParam('me', $myID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
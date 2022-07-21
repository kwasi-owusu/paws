<?php

require_once '../../../model/connection.php';
class POActionModel
{
    static public function actOnPO($tbl_a, $tbl_c, $tbl_e, $data){
        if ($data['ur'] != 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.po_ID, $tbl_a.po_num, $tbl_a.purchase_order_type, $tbl_a.supp_ID,  $tbl_a.ets, $tbl_a.eta, 
        $tbl_a.sched_dt, $tbl_a.instruction_details, $tbl_a.addedBy, $tbl_a.AddedOn, $tbl_c.po_ID, $tbl_c.curr, $tbl_c.pmt_terms, $tbl_c.price_factor, $tbl_c.freightType, 
        $tbl_c.freight_amt, $tbl_c.nhil, $tbl_c.getFund, $tbl_c.covidAmount, $tbl_c.before_vat, $tbl_c.vat, $tbl_c.amtDue, $tbl_c.amt_paid, $tbl_c.grand_total, 
        $tbl_e.user_ID, $tbl_e.firstName, $tbl_e.LastName, $tbl_e.userEmail
        FROM $tbl_a, $tbl_c, $tbl_e
        WHERE $tbl_a.po_ID = :id
        AND $tbl_a.po_ID = $tbl_c.po_ID
        AND $tbl_a.branch_owner = :ub
        AND $tbl_a.addedBy = $tbl_e.user_ID
        ");

            $stmt->bindParam('id', $data['po_ID'], PDO::PARAM_STR);
            $stmt->bindParam('ub', $data['ub'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }
        elseif ($data['ur'] == 1){
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.po_ID, $tbl_a.po_num, $tbl_a.purchase_order_type, $tbl_a.supp_ID,  $tbl_a.ets, $tbl_a.eta, 
        $tbl_a.sched_dt, $tbl_a.instruction_details, $tbl_a.addedBy, $tbl_a.AddedOn, $tbl_c.po_ID, $tbl_c.curr, $tbl_c.pmt_terms, $tbl_c.price_factor, $tbl_c.freightType, 
        $tbl_c.freight_amt, $tbl_c.nhil, $tbl_c.getFund, $tbl_c.covidAmount, $tbl_c.before_vat, $tbl_c.vat, $tbl_c.amtDue, $tbl_c.amt_paid, $tbl_c.grand_total, 
        $tbl_e.user_ID, $tbl_e.firstName, $tbl_e.LastName, $tbl_e.userEmail
        FROM $tbl_a, $tbl_c, $tbl_e
        WHERE $tbl_a.po_ID = :id
        AND $tbl_a.po_ID = $tbl_c.po_ID
        AND $tbl_a.addedBy = $tbl_e.user_ID
        ");

            $stmt->bindParam('id', $data['po_ID'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }

    }

    static public function poDetails($tbl, $po_ID){
        $stmt       = Connection::connect()->prepare("SELECT * FROM $tbl WHERE po_ID = :pd");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function poItemsDetails($tbl, $po_ID){
        $stmt       = Connection::connect()->prepare("SELECT * FROM $tbl WHERE po_ID = :pd AND receive_status <> 1 AND qty > 0");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }



    static public function getPFIs($tbl, $po_ID){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE po_ID = :pd");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;

    }

}
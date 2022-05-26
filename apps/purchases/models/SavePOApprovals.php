<?php

require_once '../../model/connection.php';
class SavePOApprovals
{
    static public function saveApprovals($tbl_b, $data){
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt   = $thisPDO->prepare("INSERT INTO $tbl_b(po_ID, approve_action, action_comment, approvalBy) VALUES (?, ?, ?, ?)");
                $stmt->execute(array($data['pid'], $data['pac'], $data['cm'], $data['adb']));

                $inserted_ID = $thisPDO-> lastInsertId();
                $aprLmt     = $data['al'];


                $activity_type  = "Purchase Order Action ";
                $activity = "Purchase Order Action with id ".$inserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity ));

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo "Failed";
            }
        }
    }

    static public function updateApprovalStatus($po_ID){
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        $stmt      = $thisPDO->prepare("UPDATE new_purch_oder SET approval_status = 1 WHERE po_ID = :pd");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function updatePOFinancials($tbl_u, $data_u){

        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();


        $stmt      = $thisPDO->prepare("UPDATE $tbl_u SET nhil = :nhh, getFund = :gff, before_vat = :bff, vat = :vff, final_total = :tff WHERE po_ID = :id");
        $stmt->bindParam('nhh', $data_u['nh'], PDO::PARAM_STR);
        $stmt->bindParam('gff', $data_u['gf'], PDO::PARAM_STR);
        $stmt->bindParam('bff', $data_u['sb'], PDO::PARAM_STR);
        $stmt->bindParam('vff', $data_u['vt'], PDO::PARAM_STR);
        $stmt->bindParam('tff', $data_u['gt'], PDO::PARAM_STR);
        $stmt->bindParam('id', $data_u['pd'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
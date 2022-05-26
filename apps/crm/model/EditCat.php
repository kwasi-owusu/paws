<?php
require_once '../../model/connection.php';

class EditCat
{
    static public function editCustomerCat($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET cat_name = :ccn, cat_desc = :cd, lastUpdateOn = :lln, lastUpdateBy = :llb  WHERE customer_cat_ID = :cid");
                $stmt->bindParam('ccn', $data['cn'], PDO::PARAM_STR);
                $stmt->bindParam('cd', $data['cds'], PDO::PARAM_STR);
                $stmt->bindParam('lln', $data['ln'], PDO::PARAM_STR);
                $stmt->bindParam('llb', $data['lb'], PDO::PARAM_STR);
                $stmt->bindParam('cid', $data['cd'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "Customer Category Updated";
                $activity = "Customer Category Updated with id " . $lastInsertedID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
            }
        }
    }
}
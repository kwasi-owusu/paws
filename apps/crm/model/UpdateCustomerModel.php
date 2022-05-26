<?php
require_once '../../model/connection.php';

class UpdateCustomerModel
{
    static public function updateCustomerStatus($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET customerStatus = :nct, lastUpdateOn = :on, lastUpdateBy =:ub  WHERE customa_ID = :id");
                $stmt->bindParam('nct', $data['ucs'], PDO::PARAM_INT);
                $stmt->bindParam('on', $data['nn'], PDO::PARAM_STR);
                $stmt->bindParam('ub', $data['adb'], PDO::PARAM_STR);
                $stmt->bindParam('id', $data['cd'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "Customer Status Updated";
                $activity = "Customer Status Updated with id " . $lastInsertedID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo "Error";
            }
        }
    }
}
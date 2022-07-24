<?php

require_once '../../model/connection.php';
class UpdateThisUOM
{
    static public function updateUom($tbl, $data){
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                //uom_ID, uom, uom_desc, date_added, added_by, last_update_on, last_update_by
                $stmt = $thisPDO->prepare("UPDATE $tbl SET uom = :u, uom_desc = :d, last_update_on = :ln, last_update_by = :lb WHERE uom_ID = :id");
                $stmt->bindParam('u', $data['um'], PDO::PARAM_STR);
                $stmt->bindParam('d', $data['ud'], PDO::PARAM_STR);
                $stmt->bindParam('ln', $data['lbn'], PDO::PARAM_STR);
                $stmt->bindParam('lb', $data['lbd'], PDO::PARAM_STR);
                $stmt->bindParam('id', $data['id'], PDO::PARAM_STR);
                $stmt->execute();

                //$activity_ID = $thisPDO->lastInsertId();

                $activity_type = "UOM Settings Updated";
                $activity = "UOM Settings Updated";
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details,  activity_table, table_ID, activity_officer) 
                VALUES(?, ?, ?, ?, ?)");
                $u_act->execute(array($activity_type, $activity, $tbl, $data['id'], $data['lbd']));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                if ($thisPDO->beginTransaction()) {
                    $thisPDO->rollBack();
                }
                echo "Failed";
            }
        }
    }
}
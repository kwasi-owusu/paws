<?php
require_once '../../model/connection.php';

class UomSettingsModel
{
    static public function UomMdl($tblName, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tblName(uom, uom_desc, added_by) 
                VALUES(?, ?, ?)");
                $stmt->execute(array($data['uom'], $data['dc'], $data['adb']));

                $settings_ID = $thisPDO->lastInsertId();

                $activity_type = "UOM Settings Added";
                $activity = "\"UOM Settings Added";
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details,  activity_table, table_ID, activity_officer) 
                VALUES(?, ?, ?, ?, ?)");
                $u_act->execute(array($activity_type, $activity, $tblName, $settings_ID, $data['adb']));

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
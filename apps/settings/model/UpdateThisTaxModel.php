<?php

require_once '../../model/connection.php';
class UpdateThisTaxModel
{
    static public function updateTax($update_field, $input, $tbl, $lastUpdateBy, $lastUpdateOn)
    {

        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET lastUpdateBy = :lbd, lastUpdateOn = :lbn, $update_field 
                WHERE tax_ID ='" . $input['tax_ID'] . "'");
                $stmt->bindParam('lbd', $lastUpdateBy, PDO::PARAM_STR);
                $stmt->bindParam('lbn', $lastUpdateOn, PDO::PARAM_STR);
                $stmt->execute();


                $activity_type = "Tax Settings Updated";
                $activity = "Tax Settings Updated";
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details,  activity_table, table_ID, activity_officer) 
                VALUES(?, ?, ?, ?, ?)");
                $u_act->execute(array($activity_type, $activity, $tbl, $input['tax_ID'], $lastUpdateBy));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                if ($thisPDO->beginTransaction()) {
                    $thisPDO->rollBack();
                    echo 'Failed';
                }
            }
        }
    }
}
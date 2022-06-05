<?php

require_once '../../template/statics/conn/connection.php';
class SalesLeadModel
{
    static public function addNewLead($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(lead_name, lead_source, lead_email, lead_phone, lead_type, potential_opportunity, 
                chance_of_sales, forecast_close, weighted_forecast, pipeline_stage, merchant_ID, addedBy) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['ldn'],
                    $data['lds'],
                    $data['lde'],
                    $data['ldp'],
                    $data['ldt'],
                    $data['ldo'],
                    $data['ldc'],
                    $data['ldf'],
                    $data['ldw'],
                    $data['stg'],
                    $data['md'],
                    $data['adb']
                ));

                $lastInserted_ID = $thisPDO->lastInsertId();

                //insert into sales pipeline
                $pipeline = $thisPDO->prepare("INSERT INTO sales_pipeline (lead_ID, lead_name, lead_source, lead_email, lead_phone, lead_type, 
                potential_opportunity, chance_of_sales, forecast_close, weighted_forecast, pipeline_stage, merchant_ID)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $pipeline->execute(array(
                    $lastInserted_ID, 
                    $data['ldn'],
                    $data['lds'],
                    $data['lde'],
                    $data['ldp'],
                    $data['ldt'],
                    $data['ldo'],
                    $data['ldc'],
                    $data['ldf'],
                    $data['ldw'],
                    $data['stg'],
                    $data['md'],
                ));

                $activity_type = "New Sales Lead Added";
                $activity = "Sales Lead added with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));


                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
            }
        }
    }
}

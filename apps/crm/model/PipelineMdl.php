<?php

require_once '../../template/statics/conn/connection.php';
class PipelineMdl
{

    public static function updatePipeline($tbl, $tbl_b, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt   =  $thisPDO->prepare("UPDATE $tbl SET pipeline_stage = :stg, lastUpdatedBy = :lbd WHERE pipeline_ID = :d");
                $stmt->bindParam('stg', $data['td'], PDO::PARAM_STR);
                $stmt->bindParam('d', $data['pd'], PDO::PARAM_STR);
                $stmt->bindParam('lbd', $data['lbd'], PDO::PARAM_STR);
                $stmt->execute();

                $origin_date    = Date('Y-m-d');
                $funnel_month   = Date('M');
                $funnel_year    = Date('Y');

                $update_lead = $thisPDO->prepare("UPDATE $tbl_b SET pipeline_stage = :bsg, lastUpdatedBy = :lbd WHERE lead_ID = :dd");
                $update_lead->bindParam('bsg', $data['td'], PDO::PARAM_STR);
                $update_lead->bindParam('dd', $data['pd'], PDO::PARAM_STR);
                $update_lead->bindParam('lbd', $data['lbd'], PDO::PARAM_STR);
                $update_lead->execute();
                
                $addFunnel =  $thisPDO->prepare("INSERT INTO sales_funnel(pipeline_ID, previous_pipeline_stage, current_pipeline_stage, 
                origin_date, funnel_month, funnel_year) 
                VALUES(?, ?, ?, ?, ?, ?)");
                $addFunnel->execute(
                    array(
                        $data['pd'],
                        $data['sd'],
                        $data['td'],
                        $origin_date,
                        $funnel_month,
                        $funnel_year
                    )
                );

                $thisPDO->commit();
                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
            }
        }
    }

    ################################ get sales pipeline ################################
    public static function getSalesPipeline($tbl, $data){
        $year = Date('Y');
        if ($data['ust'] == 2) {
            //merchant admin can see all sales leads for their institution
            $stmt = Connection::connect()->prepare("SELECT * FROM $tbl 
            WHERE merchant_ID = :merchant_ID 
            AND pipeline_stage = :psg
            AND YEAR(system_date) = :yr
            ORDER BY pipeline_ID DESC");
            $stmt->bindParam('merchant_ID', $data['md'], PDO::PARAM_STR);
            $stmt->bindParam('yr', $year, PDO::PARAM_STR);
            $stmt->bindParam('psg', $data['stage'], PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            // select sales leads created by only you.
            $stmt = Connection::connect()->prepare("SELECT * FROM $tbl 
            WHERE addedBy = :me 
            AND pipeline_stage = :psg
            AND YEAR(system_date) = :yr
            ORDER BY pipeline_ID DESC");

            $stmt->bindParam('me', $data['m'], PDO::PARAM_STR);
            $stmt->bindParam('yr', $year, PDO::PARAM_STR);
            $stmt->bindParam('psg', $data['stage'], PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        }
    }

    ##################33333 sales pipeline ###########################################3  

    public static function getPipelineValue($tbl, $data)
    {
        if ($data['ust'] == 2) {
            try {

                $year        = Date('Y');

                $stmt = Connection::connect()->prepare("SELECT pipeline_ID, potential_opportunity, SUM(potential_opportunity) 
            AS PipelineValue 
            FROM $tbl
            WHERE pipeline_stage = :psg
            AND YEAR(system_date) = :yr
            AND merchant_ID = :md
            ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $data['md'], PDO::PARAM_STR);
                $stmt->bindParam('psg', $data['stage'], PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Failed";
            }
        } else {
            try {

                $year        = Date('Y');

                $stmt = Connection::connect()->prepare("SELECT pipeline_ID, potential_opportunity, SUM(potential_opportunity) 
                AS PipelineValue 
                FROM $tbl
            WHERE pipeline_stage = :psg
            AND YEAR(system_date) = :yr
            AND addedBy = :me
            ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('me', $data['m'], PDO::PARAM_STR);
                $stmt->bindParam('psg', $data['stage'], PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Failed";
                echo $e->getMessage();
            }
        }
    }
}

<?php

require_once '../../template/statics/conn/connection.php';
class PipelineMdl
{

    public static function updatePipeline($tbl, $data)
    {
        $stmt   = Connection::connect()->prepare("UPDATE $tbl SET pipeline_status = :st WHERE pipeline_ID = :d");
        $stmt->bindParam('st', $data['td'], PDO::PARAM_STR);
        $stmt->bindParam('d', $data['pd'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    ##################33333 sales pipeline ###########################################3

    #### prospect pipeline #########################################
    public static function getAllProspecting($tbl_a, $tbl_b, $merchant_id, $myRole)
    {
        if ($myRole == 2) {

            try {
                $year = Date('Y');
                $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
            FROM $tbl_a
            INNER JOIN $tbl_b ON $tbl_a.lead_ID = $tbl_b.lead_ID
            WHERE $tbl_a.pipeline_stage = 'Prospecting'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
                ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetchAll();
            } catch (PDOException $e) {
                echo "Failed";
            }
        } else {
            try {
                $year = Date('Y');
                $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
            FROM $tbl_a
            INNER JOIN $tbl_b ON $tbl_a.lead_ID = $tbl_b.lead_ID
            WHERE $tbl_a.pipeline_stage = 'Prospecting'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.addedBy = :me
            AND $tbl_a.merchant_ID = :md
                ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('me', $user_ID, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetchAll();
            } catch (PDOException $e) {
                echo "Failed";
            }
        }
    }

    public static function getProspectValue($tbl_a, $merchant_id, $myRole, $user_ID)
    {
        if ($myRole == 2) {
            try {

                $year        = Date('Y');

                $stmt = Connection::connect()->prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.potential_opportunity, SUM($tbl_a.potential_opportunity) 
            AS ProspectValue 
            FROM $tbl_a
            WHERE $tbl_a.pipeline_stage = 'Prospecting'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
            ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->bindParam('me', $user_ID, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Failed";
            }
        } else {
            try {

                $year        = Date('Y');

                $stmt = Connection::connect()->prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.potential_opportunity, SUM($tbl_a.potential_opportunity) 
            AS ProspectValue 
            FROM $tbl_a
            WHERE $tbl_a.pipeline_stage = 'Prospecting'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
            AND $tbl_a.addedBy = :me
            ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->bindParam('me', $user_ID, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Failed";
            }
        }
    }

    ################## Qualifying Pipeline ################
    public static function getAllQualifying($tbl_a, $tbl_b, $merchant_id, $myRole)
    {
        if ($myRole == 2) {
            try {
                $year = Date('Y');
                $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
            FROM $tbl_a
            INNER JOIN $tbl_b ON $tbl_a.lead_ID = $tbl_b.lead_ID
            WHERE $tbl_a.pipeline_stage = 'Qualifying'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
                ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetchAll();
            } catch (PDOException $e) {
                echo "Failed";
            }
        } else {
            try {
                $year = Date('Y');
                $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
            FROM $tbl_a
            INNER JOIN $tbl_b ON $tbl_a.lead_ID = $tbl_b.lead_ID
            WHERE $tbl_a.pipeline_stage = 'Qualifying'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
            AND $tbl_a.addedBy = :me
                ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->bindParam('me', $user_ID, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetchAll();
            } catch (PDOException $e) {
                echo "Failed";
            }
        }
    }

    public static function getQualifyingValue($tbl_a, $merchant_id, $myRole)
    {
        if ($myRole == 2) {
            try {

                $year        = Date('Y');

                $stmt = Connection::connect()->prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.potential_opportunity, SUM($tbl_a.potential_opportunity) 
            AS ProspectValue 
            FROM $tbl_a
            WHERE $tbl_a.pipeline_stage = 'Qualifying'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
            ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Failed";
            }
        }

        else{
            try {

                $year        = Date('Y');

                $stmt = Connection::connect()->prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.potential_opportunity, SUM($tbl_a.potential_opportunity) 
            AS ProspectValue 
            FROM $tbl_a
            WHERE $tbl_a.pipeline_stage = 'Qualifying'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
            AND $tbl_a.addedBy = :me
            ");
                $stmt->bindParam('yr', $year, PDO::PARAM_STR);
                $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
                $stmt->bindParam('me', $user_ID, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Failed";
            }
        }
    }

    public static function getQualifyingFunnel($tbl_a, $merchant_id, $myRole)
    {
        try {

            $year        = Date('Y');

            $stmt = Connection::connect()->prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.potential_opportunity, SUM($tbl_a.potential_opportunity) 
            AS ProspectValue 
            FROM $tbl_a
            WHERE $tbl_a.pipeline_stage = 'Qualifying'
            AND YEAR($tbl_a.system_date) = :yr
            AND $tbl_a.merchant_ID = :md
            ");
            $stmt->bindParam('yr', $year, PDO::PARAM_STR);
            $stmt->bindParam('md', $merchant_id, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Failed";
        }
    }

    public function qualifiedFromProspecting($tbl_a, $tbl_b, $merchant_id, $myRole)
    {
        $year        = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT lead_ID, potential_opportunity, COUNT(pipeline_stage) AS total_lead, merchant_ID, system_date 
        FROM sales_pipeline WHERE pipeline_stage = 'Qualifying'
        AND merchant_ID = :md
        AND YEAR(system_date) = :yr
        AND pipeline_stage IN (SELECT * FROM sales_funnel WHERE previous_pipeline_stage = 'Prospecting')");
    }
}

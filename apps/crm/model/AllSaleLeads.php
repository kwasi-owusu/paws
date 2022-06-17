<?php
require_once '../../template/statics/conn/connection.php';

class AllSaleLeads
{
    public static function SalesLeads($tbl, $data)
    {

        if ($data['ust'] == 2) {
            //merchant admin can see all sales leads for their institution

            $stmt = Connection::connect()->prepare("SELECT * FROM $tbl 
            WHERE merchant_ID = :merchant_ID 
            AND pipeline_stage = 'Prospecting'
            ORDER BY lead_ID DESC");
            $stmt->bindParam('merchant_ID', $data['md'], PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        } else {

            // select sales leads created by only you.
            $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE addedBy = :me AND pipeline_stage = 'Prospecting' ORDER BY lead_ID DESC");
            $stmt->bindParam('me', $data['m'], PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        }
    }

    
    
}

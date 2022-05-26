<?php

require_once '../../model/connection.php';
class GetInventoryValueMdl
{
    static public function totalInventoryValue($tbl){
        $stmt   = Connection::connect()->prepare("SELECT SUM(recieved_qty * unit_cost) AS totalVal FROM $tbl WHERE recieved_qty > 0
        ");
        $stmt->execute();

        return $stmt;
    }

    static public function totalInventoryValueByWH($tbl){
        $stmt   = Connection::connect()->prepare("SELECT storage_ID, product_code, product_name, unit_cost, 
        SUM(recieved_qty * unit_cost) AS totalValGroup FROM $tbl
        WHERE recieved_qty > 0 GROUP BY wh_stored
        ");
        $stmt->execute();

        return $stmt;
    }

    static public function totalScrapValue($tbl){
        $yy     = Date('Y');
        $stmt   = Connection::connect()->prepare("SELECT SUM(scrap_qty * unit_cost) AS totalScrapVal FROM $tbl
        WHERE approval_status = 1
        AND yr = :y
        ");
        $stmt->bindParam('y', $yy, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
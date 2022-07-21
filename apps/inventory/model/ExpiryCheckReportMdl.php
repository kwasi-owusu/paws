<?php

require_once '../../../model/connection.php';
class ExpiryCheckReportMdl
{
    static public function getMonthsToCheckReport($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl");
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function checkExpiryReport($no_of_month, $tbl, $tbl_b, $tbl_c){
        $stmt = Connection::connect()->prepare("SELECT $tbl.*, $tbl_b.*, $tbl_c.* 
        FROM $tbl 
        INNER JOIN $tbl_b ON $tbl.inventory_cat = $tbl_b.cat_ID
        INNER JOIN $tbl_c ON $tbl.inventory_sub_cat = $tbl_c.sub_cat_ID
        WHERE $tbl.expiry_dt <= DATE_ADD(CURDATE(), INTERVAL $no_of_month MONTH) AND $tbl.whse_qty > 0");

        //$stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE expiry_dt <= DATE_ADD(CURDATE(), INTERVAL $no_of_month MONTH) AND whse_qty > 0");
        $stmt->execute();

        return $stmt;
    }
}
<?php

require_once '../../model/connection.php';
class ExpiryCheckMonth
{
    static public function getMonthsToCheck($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl");
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function checkExpiry($no_of_month, $tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE expiry_dt <= DATE_ADD(CURDATE(), INTERVAL $no_of_month MONTH) AND whse_qty > 0");
        $stmt->execute();

        return $stmt->rowCount();
    }
}
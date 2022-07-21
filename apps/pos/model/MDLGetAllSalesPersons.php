<?php

require_once '../../../../model/connection.php';
class MDLGetAllSalesPersons
{
    static public function AllSalesPersons($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE userRole = 13 ORDER BY firstName ASC");
        $stmt->execute();

        return $stmt;
    }
}
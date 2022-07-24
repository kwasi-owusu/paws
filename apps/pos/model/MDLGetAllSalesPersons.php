<?php

require_once '../../../template/statics/conn/connection.php';
class MDLGetAllSalesPersons
{
    static public function AllSalesPersons($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE userRole = 4 AND userStatus = 1 ORDER BY firstName ASC");
        $stmt->execute();

        return $stmt;
    }
}
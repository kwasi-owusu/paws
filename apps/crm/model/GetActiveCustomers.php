<?php

require_once '../../model/connection.php';
class GetActiveCustomers
{
    static public function  loadActiveCustomers($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl");
        $stmt->execute();

        return $stmt->rowCount();
    }
}
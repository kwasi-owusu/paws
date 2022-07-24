<?php

require_once '../../../model/connection.php';
class GetAllTaxModel
{
    static public function getAllTax($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY tax_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
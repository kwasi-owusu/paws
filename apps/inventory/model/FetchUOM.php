<?php

require_once '../../../model/connection.php';
class FetchUOM
{
    static public function getAllUOM($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY uom ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
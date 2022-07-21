<?php

require_once '../../../model/connection.php';
class FetchAllInventoryCategory
{
    static public function getAllInventoryCategory($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
<?php

require_once '../../model/connection.php';
class GetAllInventory
{
    static public function loadAllInventory($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt;
    }
}
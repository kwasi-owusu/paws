<?php

require_once '../../template/statics/conn/connection.php';
class GetAllInventory
{
    public static function loadAllInventory($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt;
    }
}
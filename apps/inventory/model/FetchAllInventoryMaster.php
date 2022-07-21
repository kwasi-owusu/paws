<?php


class FetchAllInventoryMaster
{
    static public function allInventoryMaster($tbl){
        require_once '../../../model/connection.php';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE InventoryStatus = 1 ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function allPendingInventoryMaster($tbl){
        require_once '../../../model/connection.php';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE InventoryStatus = 0 ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
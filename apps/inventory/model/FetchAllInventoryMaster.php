<?php


class FetchAllInventoryMaster
{
    public static function allInventoryMaster($tbl){
        require_once '../../template/statics/conn/connection.php';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE InventoryStatus = 1 ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function allPendingInventoryMaster($tbl){
        require_once '../../template/statics/conn/connection.php';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE InventoryStatus = 0 ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
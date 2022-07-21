<?php

require_once '../../../../model/connection.php';
class GetInventoryCatForModal
{
    static public function InventoryCatForModal($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
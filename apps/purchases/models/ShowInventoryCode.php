<?php

require_once '../../model/connection.php';
class ShowInventoryCode
{
    static public function inventoryCodeSearch($tbl, $getCode){

        $stmt   = Connection::connect()->prepare("SELECT inventory_code, inventory_name FROM $tbl
        WHERE inventory_name = :code");
        $stmt->bindParam('code', $getCode, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
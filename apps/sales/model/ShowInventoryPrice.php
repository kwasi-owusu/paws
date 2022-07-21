<?php

require_once '../../model/connection.php';
class ShowInventoryPrice
{
    static public function inventoryPriceSearch($tbl, $getCode){

        $stmt   = Connection::connect()->prepare("SELECT inventory_code, inventory_name, unit_value FROM $tbl
        WHERE inventory_name = :code");
        $stmt->bindParam('code', $getCode, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
<?php

require_once '../../model/connection.php';
class ShowRMPrices
{
    static public function RMInventoryPriceSearch($tbl, $getCode){

        $stmt   = Connection::connect()->prepare("SELECT inventory_code, inventory_name, unit_value FROM $tbl
        WHERE inventory_name = :code");
        $stmt->bindParam('code', $getCode, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
<?php

require_once '../../../model/connection.php';
//require_once '../../../model/connection.php';
class GetThisSupplierModel
{
    static public function callThisSupplier($supplier_ID){
        $stmt = Connection::connect()->prepare("SELECT * FROM suppliers WHERE supp_ID = :sd");
        $stmt->bindParam('sd', $supplier_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
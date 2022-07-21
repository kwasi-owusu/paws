<?php

require_once '../../../../model/connection.php';
class GetThisSupplierStatusModel
{
    static public function getStatus($tbl, $supplier_ID){

        $stmt = Connection::connect() ->prepare("SELECT * FROM $tbl WHERE supp_ID = :sd");
        $stmt->bindParam('sd', $supplier_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
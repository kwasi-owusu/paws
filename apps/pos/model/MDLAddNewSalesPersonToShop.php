<?php

require_once '../../model/connection.php';
class MDLAddNewSalesPersonToShop
{
    static public function saveSalesPerson($tbl, $data){

        $stmt   = Connection::connect()->prepare("INSERT INTO $tbl(sales_person, pos_store_ID, addedBy)VALUES (?, ?, ?)");
        $stmt->execute(array(
            $data['sp'],
            $data['sd'],
            $data['adb']
        ));

        return $stmt;
    }

    static public function checkIfSalesOfficerAdded($tbl, $data){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE sales_person = :sp AND pos_store_ID = :pss LIMIT 1");
        $stmt->bindParam('sp', $data['sp'], PDO::PARAM_STR);
        $stmt->bindParam('pss', $data['sd'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
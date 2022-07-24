<?php

require_once '../../template/statics/conn/connection.php';
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
    
    static public function updateSalesPerson($tbl, $data){

        $stmt   = Connection::connect()->prepare("UPDATE $tbl  SET pos_store_ID = :sd, sales_person_status = 1 WHERE sales_person = :sp");
        $stmt->bindParam(':sd', $data['sd'], PDO::PARAM_INT);
        $stmt->bindParam(':sp', $data['sp'], PDO::PARAM_INT);
        $stmt->execute();

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
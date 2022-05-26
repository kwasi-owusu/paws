<?php

require_once '../../../../model/connection.php';
class CallThisCustomer
{
    static public function selectThisCustomer($tbl, $cust_ID){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE customa_ID = :cd LIMIT 1");
        $stmt->bindParam('cd', $cust_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
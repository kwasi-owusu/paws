<?php

require_once '../../../template/statics/conn/connection.php';
class CallThisCustomer
{
    public static function selectThisCustomer($tbl_a, $tbl_b, $tbl_c, $cust_ID){
        // $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE customa_ID = :cd LIMIT 1");
        // $stmt->bindParam('cd', $cust_ID, PDO::PARAM_STR);
        // $stmt->execute();

        // return $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.* 
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.country = $tbl_b.id 
        INNER JOIN $tbl_c ON $tbl_a.state = $tbl_c.id
        WHERE customa_ID = :cd LIMIT 1
        ");
        $stmt->bindParam('cd', $cust_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
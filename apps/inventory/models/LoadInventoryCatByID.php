<?php

require_once '../../../../model/connection.php';
class LoadInventoryCatByID
{
    static public function callCatByID($tbl, $data){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE cat_ID = :cd");
        $stmt->bindParam('cd', $data['cd'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function callThisInventory($tbl, $data){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE stock_ID = :cd");
        $stmt->bindParam('cd', $data['d'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function callThisFG($tbl, $data){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE inventory_ID = :cd");
        $stmt->bindParam('cd', $data['d'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
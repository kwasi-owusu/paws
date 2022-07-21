<?php

require_once '../../../../model/connection.php';
class ThisPOItems
{
    static public function thisItems($tbl, $po_ID){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE po_ID = :id");
        $stmt->bindParam('id', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
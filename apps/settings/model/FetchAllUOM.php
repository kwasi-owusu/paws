<?php

require_once '../../template/statics/conn/connection.php';
class FetchAllUOM
{
    static public function callAllUOM($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY uom ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function callThisUOM($tbl, $uomID){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE uom_ID = :id");
        $stmt->bindParam('id', $uomID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
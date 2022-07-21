<?php

require_once '../../template/statics/conn/connection.php';
class ExpiryCheckMle
{
    static public function checkNoOfMonths($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl");
        $stmt->execute();

        return $stmt;
    }
}
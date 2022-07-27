<?php

class GetAllBrands{
    public static function getAllBrands($tbl){
        require_once '../../template/statics/conn/connection.php';

        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
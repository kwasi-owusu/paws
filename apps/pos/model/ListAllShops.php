<?php

require_once '../../template/statics/conn/connection.php';
class ListAllShops
{
    public static function loadAllShops($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY store_ID ASC");
        $stmt->execute();

        return $stmt;
    }
}
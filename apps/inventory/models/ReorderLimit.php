<?php

require_once '../../model/connection.php';
class ReorderLimit
{
    static public function getReorderRule($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE total_qty <= re_order_rule ");
        $stmt->execute();

        return $stmt;
    }
}
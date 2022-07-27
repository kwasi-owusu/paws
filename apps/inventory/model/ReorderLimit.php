<?php

require_once '../../template/statics/conn/connection.php';
class ReorderLimit
{
    public static function getReorderRule($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE total_qty <= re_order_rule ");
        $stmt->execute();

        return $stmt;
    }
}
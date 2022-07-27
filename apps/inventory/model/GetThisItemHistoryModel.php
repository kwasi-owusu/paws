<?php

require_once '../../template/statics/conn/connection.php';
class GetThisItemHistoryModel
{
    public static function thisInventoryHistoryModel($tbl_a, $tbl_b){
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.history_ID, $tbl_a.storage_ID, $tbl_a.product_code, $tbl_a.batch_num, $tbl_a.activity_type, 
        $tbl_a.activity_qty, $tbl_a.activity_status, $tbl_a.addedBy, $tbl_a.addedOn, $tbl_b.storage_ID, $tbl_b.product_code, $tbl_b.batch_num
        FROM $tbl_a, $tbl_b
        WHERE $tbl_a.storage_ID = $tbl_b.storage_ID
        AND $tbl_a.product_code = $tbl_b.product_code
        AND $tbl_a.batch_num = $tbl_b.batch_num
        ");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
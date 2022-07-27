<?php

require_once '../../template/statics/conn/connection.php';
class ReorderLimitReport
{
    public static function getReorderRuleRpt($tbl, $tbl_b, $tbl_c){

        $stmt = Connection::connect()->prepare("SELECT $tbl.*, $tbl_b.*, $tbl_c.* 
        FROM $tbl 
        INNER JOIN $tbl_b ON $tbl.inventory_cat = $tbl_b.cat_ID
        INNER JOIN $tbl_c ON $tbl.invenotory_sub_cat = $tbl_c.sub_cat_ID
        WHERE $tbl.total_qty <= $tbl.re_order_rule ");
        $stmt->execute();

        return $stmt;
    }
}
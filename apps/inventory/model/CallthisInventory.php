<?php

require_once '../../template/statics/conn/connection.php';
class CallthisInventory
{

    public static function thisInventoryItem($tbl_a, $tbl_b, $tbl_c, $tbl_d, $inventory_ID){
        $stmt   = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.*
        FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d 
        WHERE $tbl_a.inventory_ID = :ci 
        AND $tbl_a.inventory_cat = $tbl_b.cat_ID
        AND $tbl_a.invenotory_sub_cat = $tbl_c.sub_cat_ID
        AND $tbl_a.base_uom = $tbl_d.uom
        LIMIT 1");
        $stmt->bindParam('ci', $inventory_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
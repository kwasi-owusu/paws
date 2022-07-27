<?php

require_once '../../../template/statics/conn/connection.php';
class GetInventoryCatForModal
{
    public static function InventoryCatForModal($tbl){
        //inventory_cat
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function InventorySubCatForModal($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY sub_cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function getAllUOM($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY uom ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    
    static public function getAllBrandsForModal($tbl){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function thisInventoryItem($tbl_a, $tbl_b, $tbl_c, $tbl_d, $inventory_ID){
        try{
        $stmt   = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.*
        FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d 
        WHERE $tbl_a.inventory_ID = :ci 
        AND $tbl_a.inventory_cat_ID = $tbl_b.cat_ID
        AND $tbl_a.invenotory_sub_cat_ID = $tbl_c.sub_cat_ID
        AND $tbl_a.base_uom = $tbl_d.uom
        LIMIT 1");
        $stmt->bindParam('ci', $inventory_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
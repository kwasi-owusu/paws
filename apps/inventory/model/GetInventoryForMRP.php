<?php

require_once '../../../model/connection.php';
class GetInventoryForMRP
{
    static public function getFG(){

        $stmt   = Connection::connect()->prepare("SELECT inventory_master.*, inventory_cat.* 
        FROM inventory_master 
        INNER JOIN inventory_cat ON inventory_master.inventory_cat = inventory_cat.cat_ID 
        WHERE inventory_master.inventory_cat = 1
        ORDER BY inventory_master.inventory_name ASC
        ");
        $stmt->execute();

        return $stmt;
    }

    static public function getOtherMaterialsG(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM inventory_master WHERE inventory_cat <> 1 ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt;
    }

    static public function getFGItemsWithBOM($my_branch, $userType){
        if ($userType != 1) {
            $stmt = Connection::connect()->prepare("SELECT DISTINCT(inventory_master.inventory_code), inventory_master.inventory_code, 
        inventory_master.inventory_ID, inventory_master.inventory_code, inventory_master.inventory_name, inventory_master.Internal_ref, 
        inventory_master.re_order_rule, mrp_bom.fg_itm 
        FROM inventory_master 
        INNER JOIN mrp_bom ON inventory_master.inventory_ID = mrp_bom.fg_itm
        WHERE mrp_bom.branch_owner = :mb
        ORDER BY inventory_master.inventory_name ASC
        ");
            $stmt->bindParam('mb', $my_branch, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }
        else{
            $stmt   = Connection::connect()->prepare("SELECT DISTINCT(inventory_master.inventory_code), inventory_master.inventory_code, 
        inventory_master.inventory_ID, inventory_master.inventory_code, inventory_master.inventory_name, inventory_master.Internal_ref, 
        inventory_master.re_order_rule, mrp_bom.fg_itm 
        FROM inventory_master 
        INNER JOIN mrp_bom ON inventory_master.inventory_ID = mrp_bom.fg_itm
        ORDER BY inventory_master.inventory_name ASC
        ");
            $stmt->execute();

            return $stmt;
        }
    }
}
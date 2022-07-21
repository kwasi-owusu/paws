<?php

require_once '../../model/connection.php';
class GetAllInventoryDetails
{
    static public function allInventoryDetails($inventory_code){
        $stmt   = Connection::connect()->prepare("SELECT inventory_master.inventory_code, inventory_master.inventory_cat, 
        inventory_master.invenotory_sub_cat, inventory_cat.cat_ID, inventory_cat.cat_name, inventory_cat.cat_desc, inventory_sub_cat.sub_cat_ID, 
        inventory_sub_cat.cat_ID, inventory_sub_cat.sub_cat_name
        FROM inventory_master
        INNER JOIN inventory_cat ON inventory_master.inventory_cat = inventory_cat.cat_ID
        INNER JOIN inventory_sub_cat ON inventory_master.invenotory_sub_cat = inventory_sub_cat.sub_cat_ID
        WHERE inventory_master.inventory_code = :iv
        ");
        $stmt->bindParam('iv', $inventory_code, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}

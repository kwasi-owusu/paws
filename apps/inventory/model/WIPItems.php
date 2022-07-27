<?php
require_once '../../template/statics/conn/connection.php';
class WIPItems
{
    public static function thisWIPItems(){
        $stmt   = Connection::connect()->prepare("SELECT rm_request.*, inventory_master.* 
        FROM rm_request 
        INNER JOIN inventory_master ON rm_request.finished_product = inventory_master.inventory_ID
        WHERE rm_request.production_status = 1
        ");
        $stmt->execute();

        return $stmt;
    }
}
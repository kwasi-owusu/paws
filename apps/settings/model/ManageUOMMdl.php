<?php

require_once '../../model/connection.php';
class ManageUOMMdl
{
    static public function manageUOM($tbl, $data){
        $stmt   = Connection::connect()->prepare("INSERT INTO $tbl (inventory_ID, base_uom, transaction_type, related_uom, conversion_fig, addedBy) 
        VALUES(?, ?, ?, ?, ?, ?)");

        $stmt->execute(array(
            $data['ivd'],
            $data['bu'],
            $data['rtr'],
            $data['ru'],
            $data['cv'],
            $data['adb'],

        ));

        return $stmt;
    }
}
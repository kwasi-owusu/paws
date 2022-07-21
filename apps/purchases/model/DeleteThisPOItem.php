<?php

require_once '../../model/connection.php';
class DeleteThisPOItem
{
    static public function deleteThis($tbl, $po_ID){
        $stmt = Connection::connect()->prepare("UPDATE $tbl SET del_state = 1 WHERE po_ID = :pd");
        $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
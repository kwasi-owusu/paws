<?php

require_once '../../../model/connection.php';
class SupplierPurchaseHistoryMdl
{

    static public function getSuppID($tbl, $supp_key){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE supplier_key = :sk");
        $stmt->bindParam('sk', $supp_key, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function supplierHistory($tbl, $supp_ID){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE supp_ID = :id ORDER BY po_ID DESC");
        $stmt->bindParam('id', $supp_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function supplierHistoryWithDateRange($tbl, $supplierID, $start_date, $end_date){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE supp_ID = :id AND AddedOn BETWEEN :sd AND :ed ORDER BY po_ID DESC");
        $stmt->bindParam('id', $supplierID, PDO::PARAM_STR);
        $stmt->bindParam('sd', $start_date, PDO::PARAM_STR);
        $stmt->bindParam('ed', $end_date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
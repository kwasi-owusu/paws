<?php

require_once '../../../model/connection.php';
class AllSuppliersList
{
    static public function getAllSuppliers(){
        $stmt = Connection::connect()->prepare("SELECT suppliers.*, suppliercategories.*
        FROM suppliers
        INNER JOIN suppliercategories ON suppliers.SupplCat = suppliercategories.sup_cat_ID
        ORDER BY suppliers.supp_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }


    static public function countAllSuppliers(){
        $stmt = Connection::connect()->prepare("SELECT suppliers.*, suppliercategories.*
        FROM suppliers
        INNER JOIN suppliercategories ON suppliers.SupplCat = suppliercategories.sup_cat_ID
        ORDER BY suppliers.supp_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
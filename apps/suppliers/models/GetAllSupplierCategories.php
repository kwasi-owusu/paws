<?php

require_once '../../../model/connection.php';
class GetAllSupplierCategories
{
    static public function loadAllSupplierCategories(){
        $stmt = Connection::connect()->prepare("SELECT * FROM suppliercategories ORDER BY category_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
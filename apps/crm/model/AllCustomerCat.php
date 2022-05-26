<?php
require_once '../../../model/connection.php';

class AllCustomerCat
{
    static public function fetchAllCustomerCat($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM customercategories ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
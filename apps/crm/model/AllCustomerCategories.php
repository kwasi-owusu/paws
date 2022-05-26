<?php
require_once '../../../../model/connection.php';

class AllCustomerCategories
{
    static public function AllCustomerCat($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
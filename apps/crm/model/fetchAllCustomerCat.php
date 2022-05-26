<?php

require_once '../../../../model/connection.php';
class fetchAllCustomerCat
{
    static public function loadAllCustomerCat($tbl){
        $stmt = Connection::connect()->prepare("SELECT * FROM customercategories ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
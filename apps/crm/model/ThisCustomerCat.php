<?php

require_once '../../../../model/connection.php';
class ThisCustomerCat
{
    static public function fetchThisCustomerCat($tbl, $cat_ID){
        $stmt = Connection::connect()->prepare("SELECT * FROM customercategories WHERE customer_cat_ID = :cd");
        $stmt->bindParam('cd', $cat_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
<?php

require_once '../../model/connection.php';
class ShowLiveProductSearch
{
    static public function productLiveSearch($tbl){
        $searchTerm = $_GET['term'];
        $stmt   = Connection::connect()->prepare("SELECT inventory_code, inventory_name FROM $tbl
        WHERE inventory_name LIKE '%".$searchTerm."%' AND inventory_cat <> 1 ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt;
    }
}
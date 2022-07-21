<?php

require_once '../../model/connection.php';
class ShowLiveFGProductSearch
{
    static public function FGProductLiveSearch($tbl){
        $searchTerm = $_GET['term'];
        $stmt   = Connection::connect()->prepare("SELECT inventory_code, inventory_name FROM $tbl
        WHERE inventory_name LIKE '%".$searchTerm."%' 
        AND inventory_cat = 1 AND 6
        ORDER BY inventory_name ASC");
        $stmt->execute();

        return $stmt;
    }
}
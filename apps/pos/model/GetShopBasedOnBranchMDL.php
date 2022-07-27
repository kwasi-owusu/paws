<?php
require_once '../../template/statics/conn/connection.php';

class GetShopBasedOnBranchMDL{
    public static function loadAllShopsByBranch($tbl, $data){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE store_physical_location = :brn ORDER BY store_name ASC");
        $stmt->bindParam('brn', $data['brn'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
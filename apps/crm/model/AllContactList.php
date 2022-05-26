<?php

require_once '../../template/statics/conn/connection.php';
class AllContactList
{
    static public function AllCustomerCat($tbl, $me, $data_owner){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE data_owner = :dow ORDER BY contact_name ASC");
        $stmt->bindParam('dow', $data_owner, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
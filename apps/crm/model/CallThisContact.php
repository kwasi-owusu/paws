<?php

require_once '../../../../model/connection.php';
class CallThisContact
{
    static public function selectThisContact($tbl, $cnt_ID){
        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE contact_ID = :cd LIMIT 1");
        $stmt->bindParam('cd', $cnt_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
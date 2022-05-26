<?php

require_once '../../model/connection.php';
class SaveNewStore
{
    static public function CreateThisStore($tbl, $data){
        $stmt   = Connection::connect()->prepare("INSERT INTO $tbl(store_code, store_name, store_physical_location, 
        defaultCurr, addedBy, branch_owner) 
                    VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(array(
           $data['stc'],
            $data['stn'],
            $data['spl'],
            $data['dcr'],
            $data['adb'],
            $data['brn'],
        ));

        return $stmt;
    }

    //check if store exist
    static public function checkIfStoreExist($tbl, $dt){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE store_name = :sn AND store_physical_location = :spl");
        $stmt->bindParam('sn', $dt['stn'], PDO::PARAM_STR);
        $stmt->bindParam('spl', $dt['spl'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
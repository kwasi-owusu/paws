<?php

require_once '../../template/statics/conn/connection.php';
class SaveNewStore
{
    static public function CreateThisStore($tbl, $data){
        $stmt   = Connection::connect()->prepare("INSERT INTO $tbl(store_code, store_name, store_physical_location, 
        defaultCurr, addedBy, merchant_ID, branch_owner) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute(array(
           $data['stc'],
            $data['stn'],
            $data['spl'],
            $data['dcr'],
            $data['adb'],
            $data['md'],
            $data['brn'],
        ));

        return $stmt;
    }

    //check if store exist
    static public function checkIfStoreExist($tbl, $data){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE store_name = :sn AND merchant_ID = :mcd");
        $stmt->bindParam('sn', $data['stn'], PDO::PARAM_STR);
        $stmt->bindParam('mcd', $data['md'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
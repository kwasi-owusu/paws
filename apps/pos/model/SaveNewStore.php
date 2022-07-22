<?php

require_once '../../template/statics/conn/connection.php';
class SaveNewStore
{
    static public function CreateThisStore($tbl, $data)
    {
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
    static public function checkIfStoreExist($tbl, $data)
    {
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE store_name = :sn AND merchant_ID = :mcd");
        $stmt->bindParam('sn', $data['stn'], PDO::PARAM_STR);
        $stmt->bindParam('mcd', $data['md'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function updateThisStore($tbl, $data)
    {
        $stmt   = Connection::connect()->prepare("UPDATE $tbl SET store_name = :store_name, store_physical_location = :sl, lastUpdateBy = :lbd, 
        lastUpdateOn = :lbn  
        WHERE store_ID = :sd AND merchant_ID = :md");
        $stmt->bindParam('store_name', $data['stn'], PDO::PARAM_STR);
        $stmt->bindParam('sl', $data['spl'], PDO::PARAM_STR);
        $stmt->bindParam('lbd', $data['adb'], PDO::PARAM_STR);
        $stmt->bindParam('lbn', $data['lbn'], PDO::PARAM_STR);
        $stmt->bindParam('sd', $data['sd'], PDO::PARAM_STR);
        $stmt->bindParam('md', $data['md'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }

    static public function updateThisStoreStatus($tbl, $tbl_b, $tbl_c, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt   = $thisPDO->prepare("UPDATE $tbl SET shop_status = :st, lastUpdateBy = :lbd, lastUpdateOn = :lbn  
                WHERE store_ID = :sd AND merchant_ID = :md");
                $stmt->bindParam('st', $data['sst'], PDO::PARAM_STR);
                $stmt->bindParam('lbd', $data['adb'], PDO::PARAM_STR);
                $stmt->bindParam('lbn', $data['lbn'], PDO::PARAM_STR);
                $stmt->bindParam('sd', $data['sd'], PDO::PARAM_STR);
                $stmt->bindParam('md', $data['md'], PDO::PARAM_STR);

                $stmt->execute();

                // if store status is deactivated, update all user status for the store.
                if( $data['sst'] == 2){
                $sst = $thisPDO->prepare("UPDATE $tbl_b SET sales_person_status = 0 WHERE pos_store_ID = :sd");
                $sst->bindParam('sd', $data['sd'], PDO::PARAM_STR);
                $sst->execute();
                }

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
            }
        }
    }
}

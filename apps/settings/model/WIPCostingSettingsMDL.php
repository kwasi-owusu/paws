<?php

require_once '../../model/connection.php';
class WIPCostingSettingsMDL
{
    static public function checkWIPCostingType($tbl, $data){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE  data_owner = :dw");
        $stmt->bindParam('dw', $data['dw'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }

    static public function saveCostingType($tbl, $data){
        $stmt   = Connection::connect()->prepare("INSERT INTO $tbl(costing_type, addedBy, data_owner) VALUES(?, ?, ?)");
        $stmt->execute(array(
            $data['cs'],
            $data['adb'],
            $data['dw']
        ));

        return $stmt;
    }

    static public function updateCostingType($tbl, $data){
        $date   = Date('Y-m-d');
        $stmt   = Connection::connect()->prepare("UPDATE $tbl SET costing_type = :cs, lastUpdateBy = :lbd, lastUpdateOn = :lbn 
            WHERE data_owner = :dw
            ");

        $stmt->bindParam('cs', $data['cs'], PDO::PARAM_STR);
        $stmt->bindParam('lbd', $data['adb'], PDO::PARAM_STR);
        $stmt->bindParam('lbn', $date, PDO::PARAM_STR);
        $stmt->bindParam('dw', $data['dw'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }

    static public function getWIPStage($tbl, $data){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE data_owner = :dw AND stage_name = :stn");
        $stmt->bindParam('dw', $data['dw'], PDO::PARAM_STR);
        $stmt->bindParam('stn', $data['stn'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }

    static public function saveWIPStage($tbl, $data){
        $stmt   = Connection::connect()->prepare("INSERT INTO $tbl(stage_name, addedBy, data_owner) VALUES (?, ?, ?)");
        $stmt->execute(array(
            $data['stn'],
            $data['adb'],
            $data['dw']
        ));

        return $stmt;
    }

    static public function updateWIPStages($tbl, $data){
        $lastUpdateOn    = Date('Y-m-d');
        $stmt   = Connection::connect()->prepare("UPDATE $tbl SET stage_name = :stn, lastUpdateBy = :ldb, lastUpdateOn = :lbn 
        WHERE data_owner = :dw AND stage_name = :snn");
        $stmt->bindParam('stn', $data['stn'], PDO::PARAM_STR);
        $stmt->bindParam('ldb', $data['adb'], PDO::PARAM_STR);
        $stmt->bindParam('lbn', $lastUpdateOn, PDO::PARAM_STR);
        $stmt->bindParam('dw', $data['dw'], PDO::PARAM_STR);
        $stmt->bindParam('snn', $data['stn'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }


}
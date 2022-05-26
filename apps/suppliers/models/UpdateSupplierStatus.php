<?php

require_once '../../model/connection.php';
class UpdateSupplierStatus
{
    static public function editSupplierStatus($tbl, $data){
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();
        try {

            $stmt = Connection::connect() -> prepare("UPDATE $tbl SET supplierStatus = :sst, lastUpdateOn = :lln, lastUpdateBy = :llb WHERE supp_ID = :sid");
            $stmt -> bindParam('sst', $data['ss'], PDO::PARAM_STR);
            $stmt -> bindParam('sid', $data['sd'], PDO::PARAM_STR);
            $stmt -> bindParam('lln', $data['ln'], PDO::PARAM_STR);
            $stmt -> bindParam('llb', $data['lb'], PDO::PARAM_STR);

            $stmt->execute();

            $lastInsertedID = Connection::connect()-> lastInsertId();

            $activity_type  = "Supplier Status Updated";
            $activity = "Supplier Status with id ".$lastInsertedID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity ));

            $newPDO -> commit();

            return $stmt;
        } catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }
}
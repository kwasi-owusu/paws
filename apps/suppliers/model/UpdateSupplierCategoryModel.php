<?php

require_once '../../model/connection.php';
class UpdateSupplierCategoryModel
{
    static public function updateThisSupplierCat($tbl, $data){
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {

            $stmt = Connection::connect()->prepare("UPDATE $tbl SET category_name = :ctn, category_desc = :ctd, lastUpdateBy = :llb, lastUpdateOn = :lln 
            WHERE sup_cat_ID = :cdd");
            $stmt->bindParam('ctn', $data['cn']);
            $stmt->bindParam('ctd', $data['cde']);
            $stmt->bindParam('llb', $data['lb']);
            $stmt->bindParam('lln', $data['ln']);
            $stmt->bindParam('cdd', $data['cd']);
            $stmt->execute();

            $lastInserted_ID = Connection::connect()->lastInsertId();

            $activity_type = "Supplier Category Updated";
            $activity = "Supplier Category updated with id " . $lastInserted_ID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity));

            $newPDO->commit();

            return $stmt;
        } catch (PDOException $e) {
            $newPDO->rollBack();
            echo $e->getMessage();
        }
    }
}
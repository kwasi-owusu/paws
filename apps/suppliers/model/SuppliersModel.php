<?php

require_once '../../model/connection.php';

class SuppliersModel
{
    static public function addNewCategory($tbl, $data)
    {
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {

            $stmt = Connection::connect()->prepare("INSERT INTO $tbl(category_name, category_desc, addedBy) 
                VALUES(?, ?, ?)");
            $stmt->execute(array($data['cn'], $data['ctd'], $data['adb']));

            $lastInserted_ID = Connection::connect()->lastInsertId();

            $activity_type = "Supplier Category Added";
            $activity = "Supplier Category added with id " . $lastInserted_ID;
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


    static public function addNewSupplier($tbl, $data)
    {
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {

            $stmt = Connection::connect()->prepare("INSERT INTO $tbl(SupplCode, SupplCat, supp_name, newSupplierName, supp_phone, supp_email, address1, supplier_key, 
            town_city, state_region, country, contact_person, contact_person_phone, addeddby) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(array($data['spc'], $data['sup_cat'], $data['spn'], $data['nspn'], $data['sph'], $data['spe'], $data['spad'], $data['sk'], $data['tc'], $data['str'],
                $data['cntr'], $data['spcp'], $data['spcph'], $data['adb']));

            $lastInserted_ID = Connection::connect()->lastInsertId();

            $activity_type = "New Supplier Added";
            $activity = "New Supplier added with id " . $lastInserted_ID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity));

            $contact_type = "Supplier";

            $cnt = Connection::connect()->prepare("INSERT INTO contact_tbl(contact_name, contact_phone, company_name, contact_type, addedBy) VALUES (?, ?, ?, ?, ?)");
            $cnt->execute(array($data['spcp'], $data['spcph'], $data['spn'], $contact_type, $data['adb'], ));

            $newPDO->commit();

            return $stmt;
        } catch (PDOException $e) {
            $newPDO->rollBack();
            echo $e->getMessage();
        }
    }


    static public function editSupplier($tbl, $data)
    {
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {

            $stmt = Connection::connect()->prepare("UPDATE $tbl SET SupplCode = :ssc, SupplCat = :sst, supp_name = :ssn, supp_phone = :ssp, supp_email = :sse, 
            address1 = :ssa, supplier_key = :ssk, town_city = :sstc, state_region = :ssr, country = :sscn, contact_person = :sscnp, contact_person_phone = :sscph, 
            lastUpdateBy = :slb, lastUpdateOn = :sln, supplierStatus = 2 WHERE supp_ID = :sid");
            $stmt->bindParam('ssc', $data['spc'], PDO::PARAM_STR);
            $stmt->bindParam('sst', $data['sup_cat'], PDO::PARAM_STR);
            $stmt->bindParam('ssn', $data['spn'], PDO::PARAM_STR);
            $stmt->bindParam('ssp', $data['sph'], PDO::PARAM_STR);
            $stmt->bindParam('sse', $data['spe'], PDO::PARAM_STR);
            $stmt->bindParam('ssa', $data['spad'], PDO::PARAM_STR);
            $stmt->bindParam('ssk', $data['sk'], PDO::PARAM_STR);
            $stmt->bindParam('sstc', $data['tc'], PDO::PARAM_STR);
            $stmt->bindParam('ssr', $data['str'], PDO::PARAM_STR);
            $stmt->bindParam('sscn', $data['cntr'], PDO::PARAM_STR);
            $stmt->bindParam('sscnp', $data['spcp'], PDO::PARAM_STR);
            $stmt->bindParam('sscph', $data['spcph'], PDO::PARAM_STR);
            $stmt->bindParam('slb', $data['lb'], PDO::PARAM_STR);
            $stmt->bindParam('sln', $data['ln'], PDO::PARAM_STR);
            $stmt->bindParam('sid', $data['sid'], PDO::PARAM_STR);
            $stmt->execute();

            $lastInserted_ID = Connection::connect()->lastInsertId();

            $activity_type = "Supplier Updated";
            $activity = "Supplier Updated with id " . $lastInserted_ID;
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
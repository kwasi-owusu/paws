<?php

require_once '../../model/connection.php';
class CustomerModel
{
    static public function addCustomerCategory($tblName, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {


            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tblName(cat_name, cat_desc, addedBy) 
                VALUES(?, ?, ?)");
                $stmt->execute(array($data['cn'], $data['cd'], $data['adb']));

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "Customer Category Added";
                $activity = "Customer Category added with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));


                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
            }
        }
    }


    static public function addNewCustomer($tblName, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tblName(CCCode, cust_cat, customa_name, customa_email, customa_phone, customa_address1, 
            customer_key, customa_address2, town_city, state, country, contact_person, contact_person_phone, addeddBy) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($data['ccd'], $data['cc'], $data['cn'], $data['ce'], $data['cp'], $data['cad'], $data['ck'], $data['cad_b'], $data['tc'],
                    $data['st'], $data['cty'], $data['cps'], $data['cpsp'], $data['adb']));

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "New Customer Added";
                $activity = "New Customer added with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $contact_type = "Customer";

                $cnt = $thisPDO->prepare("INSERT INTO contact_tbl(contact_name, contact_phone, company_name, contact_type, addedBy) VALUES (?, ?, ?, ?, ?)");
                $cnt->execute(array($data['cps'], $data['cpsp'], $data['cn'], $contact_type, $data['adb'],));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
            }
        }
    }


    static public function editCustomer($tblName, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {


                $stmt = $thisPDO->prepare("UPDATE $tblName SET CCCode = :cccd, cust_cat = :cct, customa_name = :ccn, customa_email = :cce, 
            customa_phone = :ccp, customa_address1 = :ccad, contact_person = :cpers, contact_person_phone = :cpers_ph, customerStatus = 2, lastUpdateBy = :clb, 
            lastUpdateOn = :cln 
            WHERE customa_ID = :ccid");
                $stmt->bindParam('cccd', $data['ccd'], PDO::PARAM_STR);
                $stmt->bindParam('cct', $data['cc'], PDO::PARAM_STR);
                $stmt->bindParam('ccn', $data['cn'], PDO::PARAM_STR);
                $stmt->bindParam('cce', $data['ce'], PDO::PARAM_STR);
                $stmt->bindParam('ccp', $data['cp'], PDO::PARAM_STR);
                $stmt->bindParam('ccad', $data['cad'], PDO::PARAM_STR);
                $stmt->bindParam('cpers', $data['cps'], PDO::PARAM_STR);
                $stmt->bindParam('cpers_ph', $data['cpsp'], PDO::PARAM_STR);
                $stmt->bindParam('clb', $data['lb'], PDO::PARAM_STR);
                $stmt->bindParam('cln', $data['ln'], PDO::PARAM_STR);
                $stmt->bindParam('ccid', $data['cd'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "Customer Details Updated";
                $activity = "Customer Details Updated with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
            }
        }
    }



    static public function setCreditLimit($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {


                $stmt = $thisPDO->prepare("UPDATE $tbl SET credit_limit = :ccl, lastUpdateBy = :clb, lastUpdateOn = :cln 
            WHERE customa_ID = :ccid");
                $stmt->bindParam('ccl', $data['cl'], PDO::PARAM_STR);
                $stmt->bindParam('clb', $data['lb'], PDO::PARAM_STR);
                $stmt->bindParam('cln', $data['ln'], PDO::PARAM_STR);
                $stmt->bindParam('ccid', $data['cd'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInserted_ID =$thisPDO->lastInsertId();

                $activity_type = "Customer Credit Limit Updated";
                $activity = "Customer Credit Limit with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
            }
        }
    }

    

    static public function editContact($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET contact_name = :ccn, contact_email = :cce, contact_phone = :ccp, company_name = :ccon, 
            contact_type = :cct, contact_position = :ccpo, contact_notes = :cntss, lastUpdateBy = :llb, lastUpdateOn = :lln WHERE contact_ID = :ccid");
                $stmt->bindParam('ccn', $data['cn'], PDO::PARAM_STR);
                $stmt->bindParam('cce', $data['ce'], PDO::PARAM_STR);
                $stmt->bindParam('ccp', $data['cp'], PDO::PARAM_STR);
                $stmt->bindParam('ccon', $data['con'], PDO::PARAM_STR);
                $stmt->bindParam('cct', $data['ct'], PDO::PARAM_STR);
                $stmt->bindParam('ccpo', $data['cpo'], PDO::PARAM_STR);
                $stmt->bindParam('cntss', $data['nts'], PDO::PARAM_STR);
                $stmt->bindParam('llb', $data['lb'], PDO::PARAM_STR);
                $stmt->bindParam('lln', $data['ln'], PDO::PARAM_STR);
                $stmt->bindParam('ccid', $data['cid'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "Contact Updated";
                $activity = "Contact Updated with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));


                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
            }
        }
    }


}



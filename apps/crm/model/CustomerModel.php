<?php

require_once '../../template/statics/conn/connection.php';
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


    static public function addNewCustomer($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            // $data       = array(
            //     'cn' => $customa_name,
            //     'ccd' => $CCCode,
            //     'ce' => $customa_email,
            //     'cp' => $customa_phone,
            //     'cad' => $customer_address,
            //     'cfn' => $contact_person_fname,
            //     'cln' => $contact_person_lname,
            //     'cph' => $contact_person_phone,
            //     'adb' => $added_by,
            //     'cpe' => $contact_person_email,
            //     'ck' => $customerKey,
            //     'cad_b' => $customer_address_b,
            //     'tc' => $town_city,
            //     'st' => $state,
            //     'cty' => $country
            // );

            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(CCCode, customer_key, customa_name, customa_email, customa_phone, customa_address1, 
                town_city, state, country, addedBy, merchant_ID) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['ccd'], $data['ck'], $data['cn'], $data['ce'], $data['cp'], $data['cad'], $data['tc'],
                    $data['st'], $data['cty'], $data['adb'], $data['md']
                ));

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "New Customer Added";
                $activity = "New Customer added with id " . $lastInserted_ID;
                
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $contact_type = "Customer";

                $cnt = $thisPDO->prepare("INSERT INTO contacts(contact_key, firstName, lastName, contact_email, contact_phone, addedBy) 
                VALUES (?, ?, ?, ?, ?, ?)");
                $cnt->execute(array($data['ck'], $data['cfn'], $data['cln'], $data['cpe'], $data['cph'], $data['adb'],));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
            }
        }
    }


    static public function editCustomer($tblName, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

               
                $stmt = $thisPDO->prepare("UPDATE $tblName SET customa_name = :ccn, customa_email = :cce, customa_phone = :ccp, customa_address1 = :cad, 
                lastUpdateBy = :lbd, lastUpdateOn = :lbn 
            WHERE customa_ID = :cid");
                
                $stmt->bindParam('ccn', $data['cn'], PDO::PARAM_STR);
                $stmt->bindParam('cce', $data['ce'], PDO::PARAM_STR);
                $stmt->bindParam('ccp', $data['cp'], PDO::PARAM_STR);
                $stmt->bindParam('cad', $data['cad'], PDO::PARAM_STR);
                $stmt->bindParam('lbd', $data['lbd'], PDO::PARAM_STR);
                $stmt->bindParam('lbn', $data['lbn'], PDO::PARAM_STR);
                $stmt->bindParam('cid', $data['cd'], PDO::PARAM_STR);
                $stmt->execute();

                //$lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "Customer Details Updated";
                $activity = "Customer Details Updated by  " . $data['lbd'];
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


    public static function deleteThisCustomerSoftly($tbl, $data){
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

               
                $stmt = $thisPDO->prepare("UPDATE $tbl SET customerStatus = 3, lastUpdateBy = :lbd WHERE customa_ID = :cid");
               
                $stmt->bindParam('lbd', $data['lbd'], PDO::PARAM_STR);
                $stmt->bindParam('cid', $data['cd'], PDO::PARAM_STR);
                $stmt->execute();

                //$lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "Customer Deleted";
                $activity = "Customer Delete by  " . $data['lbd'];
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

                $lastInserted_ID = $thisPDO->lastInsertId();

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

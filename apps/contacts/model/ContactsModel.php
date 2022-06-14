<?php
require_once '../../template/statics/conn/connection.php';
class ContactsModel
{
    public static function addNewContact($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(contact_key, contact_cat, firstName, lastName, contact_email, contact_phone, company_name, job_title, 
                contact_notes, addedBy, merchant_ID) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($data['ck'], $data['cts'], $data['cfn'], $data['cln'], $data['ce'], $data['cp'], $data['con'], $data['jtt'], 
                $data['nts'], $data['adb'], $data['md']));

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "New Contact Added";
                $activity = "New Contact added with id " . $lastInserted_ID;
                
                
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

    public static function editContact($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            
            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET firstName = :fnm, lastName = :lnm, contact_email = :cem, contact_phone = :cph, 
                company_name = :cn, job_title = :jt, contact_notes = :nts, lastUpdateBy = :lbd, lastUpdateOn = :lbn WHERE contact_ID = :cid");

                $stmt->bindParam('fnm', $data['fnm'], PDO::PARAM_STR);
                $stmt->bindParam('lnm', $data['lnm'], PDO::PARAM_STR);
                $stmt->bindParam('cem', $data['cem'], PDO::PARAM_STR);
                $stmt->bindParam('cph', $data['cph'], PDO::PARAM_STR);
                $stmt->bindParam('cn', $data['cn'], PDO::PARAM_STR);
                $stmt->bindParam('jt', $data['jt'], PDO::PARAM_STR);
                $stmt->bindParam('nts', $data['nts'], PDO::PARAM_STR);
                $stmt->bindParam('lbd', $data['lb'], PDO::PARAM_STR);
                $stmt->bindParam('lbn', $data['lbn'], PDO::PARAM_STR);
                $stmt->bindParam('cid', $data['cid'], PDO::PARAM_STR);
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
                echo $e->getMessage();
            }
        }
    }

    public static function deleteThisContact($tbl, $contact_ID){
        try {
            $stmt = Connection::connect()->prepare("DELETE FROM $tbl WHERE contact_ID = :contact_ID");
            $stmt->bindParam('contact_ID', $contact_ID, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt;
        } 
        catch (PDOException $e) {
            echo $e->getMessage();
            echo "Failed";
        }
    }
}

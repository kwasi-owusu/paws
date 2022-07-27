<?php
require_once '../../model/connection.php';

class SmtpModel
{
    static public function addSmtp($tblName, $data) {
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

    try {

        $stmt = Connection::connect() -> prepare("INSERT INTO $tblName(smtp_host, smtp_port, smtp_user, smtp_pwd, email_from, added_by, data_owner) 
                VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt -> execute(array($data['smHost'], $data['smPort'], $data['smUser'], $data['smPwd'], $data['smEmail'], $data['adb'],
            $data['dow']));

        $settings_ID = Connection::connect()-> lastInsertId();

        $activity_type  = "SMTP Settings Added";
        $activity = "SMPT Details added with id ".$settings_ID;
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

    ### smtp settings
    static public function getsmtp($tblName){
        try {
            $stmt = Connection::connect() -> prepare("SELECT * FROM $tblName");
            $stmt->execute();

            return $stmt;

        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    ### update smtp settings
    static public function updatesmtp($tblName, $data){
        try {
            $stmt = Connection::connect() -> prepare("UPDATE $tblName SET smtp_host = :sh, smtp_port = :spp, smtp_user = :su, smtp_pwd = :sp, email_from = :ef, 
            added_by = :adb, data_owner = :dow");
            $stmt->bindParam('sh', $data['smHost'], PDO::PARAM_STR);
            $stmt->bindParam('spp', $data['smPort'], PDO::PARAM_STR);
            $stmt->bindParam('su', $data['smUser'], PDO::PARAM_STR);
            $stmt->bindParam('sp', $data['smPwd'], PDO::PARAM_STR);
            $stmt->bindParam('ef', $data['smEmail'], PDO::PARAM_STR);
            $stmt->bindParam('adb', $data['adb'], PDO::PARAM_STR);
            $stmt->bindParam('dow', $data['dow'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;

        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }
}
<?php

require_once '../../model/connection.php';
class ExpirySettingsModel
{
    static public function expiryMonth($table, $data){
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {
            $stmt = Connection::connect()->prepare("INSERT INTO $table(expiryMonth, added_by) VALUES (?, ?)");
            $stmt->execute(array($data['mn'], $data['adb']));

            $settings_ID = Connection::connect()-> lastInsertId();

            $activity_type  = "Expiry Month Settings Added";
            $activity = "Expiry Month Details added with id ".$settings_ID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity ));

            $newPDO -> commit();
            return $stmt;
        }
        catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }

    //update expiry month settings
    static public function updateExpiryMonth($table, $data){
        $last_update_on     = Date('Y-m-d');
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {
            $stmt = Connection::connect()->prepare("UPDATE $table SET expiryMonth = :em, last_update_on = :ln, last_update_by = :lb
            WHERE data_owner = :dow");
            $stmt->bindParam('em', $data['mn'], PDO::PARAM_STR);
            $stmt->bindParam('ln', $last_update_on, PDO::PARAM_STR);
            $stmt->bindParam('lb', $data['adb'], PDO::PARAM_STR);
            $stmt->bindParam('dow', $data['dow'], PDO::PARAM_STR);
            $stmt->execute();

            $settings_ID = Connection::connect()-> lastInsertId();

            $activity_type  = "Expiry Month Settings Update";
            $activity = "Expiry Month Details Updated with id ".$settings_ID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity ));

            $newPDO -> commit();
            return $stmt;
        }
        catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }


    //update expiry days settings
    static public function updateExpiryDays($table, $data){
        $last_update_on     = Date('Y-m-d');
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {
            $stmt = Connection::connect()->prepare("UPDATE $table SET expiryDays = :dd, last_update_on = :ln, last_update_by = :lb
            WHERE data_owner = :dow");
            $stmt->bindParam('dd', $data['dy'], PDO::PARAM_STR);
            $stmt->bindParam('ln', $last_update_on, PDO::PARAM_STR);
            $stmt->bindParam('lb', $data['adb'], PDO::PARAM_STR);
            $stmt->bindParam('dow', $data['dow'], PDO::PARAM_STR);
            $stmt->execute();

            $settings_ID = Connection::connect()-> lastInsertId();

            $activity_type  = "Expiry Month Settings Update";
            $activity = "Expiry Month Details Updated with id ".$settings_ID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity ));

            $newPDO -> commit();
            return $stmt;
        }
        catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }

    static public function restrictExpiry($table, $data){
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {
            $stmt = Connection::connect()->prepare("INSERT INTO $table(restrictMonth, added_by) VALUES (?, ?)");
            $stmt->execute(array($data['mn'], $data['adb']));

            $settings_ID = Connection::connect()-> lastInsertId();

            $activity_type  = "Restrict Issue Month Settings Added";
            $activity = "Restrict Issue Details added with id ".$settings_ID;

            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity ));

            $newPDO -> commit();
            return $stmt;
        }
        catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }

    //update expiry restriction
    static public function updateExpiryRestriction($table, $data){
        $last_update_on     = Date('Y-m-d');
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {
            $stmt = Connection::connect()->prepare("UPDATE $table SET restrictMonth = :em, last_update_on = :ln, last_update_by = :lb WHERE data_owner = :dow");
            $stmt->bindParam('em', $data['mn'], PDO::PARAM_STR);
            $stmt->bindParam('ln', $last_update_on, PDO::PARAM_STR);
            $stmt->bindParam('lb', $data['adb'], PDO::PARAM_STR);
            $stmt->bindParam('dow', $data['dow'], PDO::PARAM_STR);
            $stmt->execute();

            $settings_ID = Connection::connect()-> lastInsertId();

            $activity_type  = "Restrict Expiry Month Settings Update";
            $activity = "Restrict Expiry Month Details Updated with id ".$settings_ID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity ));

            $newPDO -> commit();
            return $stmt;
        }
        catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }
}
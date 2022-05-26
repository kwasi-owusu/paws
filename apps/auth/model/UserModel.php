<?php
require_once '../../template/statics/conn/connection.php';

class UserModel
{

    /// add a new user
    public static function addUser($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(firstName, lastName, branch_ID, userEmail, userPassword, phone_number, userRole, user_key, addedBy, 
                merchant_ID ) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($data['fn'], $data['ln'], $data['ubr'], $data['em'], $data['pd'], $data['phn'], $data['rl'], $data['usk'], $data['adb'], 
                $data['md']));

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "New User Added";
                $activity = "New User Added with id " . $lastInsertedID;
                
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo "Failed ";
                echo $e->getMessage();
            }
        }
    }

    ///add a new user role
    static public function addRole($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(roleName, role_desc, AddedBy) 
                VALUES(?, ?, ?)");
                $stmt->execute(array($data['rn'], $data['rd'], $data['adb']));

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "New User Role Added";
                $activity = "New User Role Added with id " . $lastInsertedID;
                
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


    //change user role
    static public function changeUserRole($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET userRole = :us, lastUpdateOn = :n, lastUpdateBy =:o  WHERE user_ID = :uid");
                $stmt->bindParam('us', $data['ur'], PDO::PARAM_STR);
                $stmt->bindParam('n', $data['ln'], PDO::PARAM_STR);
                $stmt->bindParam('o', $data['lb'], PDO::PARAM_STR);
                $stmt->bindParam('uid', $data['ud'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "User Role Updated";
                $activity = "User Role Updated with id " . $lastInsertedID;
                
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


    //change user details
    static public function editUserDetails($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET firstName = :fn, lastName= :ln,  userEmail =:em,phone_number = :phn, userRole =:rl, 
            lastUpdateOn = :n, lastUpdateBy =:lbd  WHERE user_ID = :uid");
                $stmt->bindParam('fn', $data['fn'], PDO::PARAM_STR);
                $stmt->bindParam('ln', $data['ln'], PDO::PARAM_STR);
                $stmt->bindParam('em', $data['em'], PDO::PARAM_STR);
                $stmt->bindParam('rl', $data['rl'], PDO::PARAM_STR);
                $stmt->bindParam('phn', $data['phn'], PDO::PARAM_STR);
                $stmt->bindParam('n', $data['nn'], PDO::PARAM_STR);
                $stmt->bindParam('lbd', $data['lbd'], PDO::PARAM_STR);
                $stmt->bindParam('uid', $data['ud'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "User Details Updated";
                $activity = "User Details Updated with id " . $lastInsertedID;
                
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
                $thisPDO->rollBack();
            }
        }
    }


    //change user status
    static public function updateUserStatus($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET UserStatus = :nst, lastUpdateOn = :on, lastUpdateBy =:ub  WHERE user_ID = :id");
                $stmt->bindParam('nst', $data['ust'], PDO::PARAM_INT);
                $stmt->bindParam('on', $data['lbn'], PDO::PARAM_STR);
                $stmt->bindParam('ub', $data['lbd'], PDO::PARAM_STR);
                $stmt->bindParam('id', $data['ud'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "User Status Updated";
                $activity = "User Status Updated with id " . $lastInsertedID;
                
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

    //change user status
    static public function updateUserPwd($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt = $thisPDO->prepare("UPDATE $tbl SET userPassword = :pd, lastUpdateOn = :on, lastUpdateBy =:ub  WHERE user_ID = :d");
                $stmt->bindParam('pd', $data['npd'], PDO::PARAM_STR);
                $stmt->bindParam('on', $data['lbn'], PDO::PARAM_STR);
                $stmt->bindParam('ub', $data['lbd'], PDO::PARAM_STR);
                $stmt->bindParam('d', $data['ud'], PDO::PARAM_STR);
                $stmt->execute();

                $lastInsertedID = $thisPDO->lastInsertId();

                $activity_type = "User Password Updated";
                $activity = "User Password Updated with id " . $lastInsertedID;
                
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
}
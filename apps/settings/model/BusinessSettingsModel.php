<?php

require_once '../../model/connection.php';
class BusinessSettingsModel
{
    static public function addBusinessSettings($tblName, $data, $folder) {

        $newPDO = Connection::connect();
        $newPDO->beginTransaction();

        try {

            $photo = "";
            list($width, $height) = getimagesize($_FILES["business_logo"]["tmp_name"]);
            $newImgWidth    = 200;
            $newImgHeight   = 180;

            $file_a = $_FILES['business_logo'];
            $rand_dt = rand(1,date('Y')) * rand(1,date('Y'));
            $n_a =  md5($rand_dt);

            if($_FILES["business_logo"]["type"] == "image/jpeg") {

                $photo = "$folder/" . $n_a . ".jpg";

                $srcImage = imagecreatefromjpeg($_FILES["business_logo"]["tmp_name"]);

                $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);

                imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);

                $stmt = Connection::connect()->prepare("INSERT INTO $tblName(comp_name, comp_phone, comp_email, website_address, address1, address2, country, 
                business_logo, added_by, data_owner) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute(array($data['cnm'], $data['cnp'], $data['cne'], $data['cnw'], $data['cna'], $data['cnb'], $data['cntry'], $photo, $data['adb'],
                    $data['dow']));
                imagejpeg($destination, $photo);

                $inserted_ID = Connection::connect()-> lastInsertId();

                $activity_type  = "Business Settings Added";
                $activity = "Business Settings Entry with id ".$inserted_ID;
                // create an activity
                $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity ));

                $newPDO -> commit();

                return $stmt;
            }

            elseif($_FILES["business_logo"]["type"] == "image/png"){

                $photo = "$folder/" . $n_a . ".png";

                $srcImage = imagecreatefrompng($_FILES["business_logo"]["tmp_name"]);
                $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);
                imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);

                $stmt = Connection::connect()->prepare("INSERT INTO $tblName(comp_name, comp_phone, comp_email, website_address, address1, address2, country, 
                business_logo, added_by, data_owner) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute(array($data['cnm'], $data['cnp'], $data['cne'], $data['cnw'], $data['cna'], $data['cnb'], $data['cntry'], $photo, $data['adb'],
                    $data['dow']));

                imagepng($destination, $photo);

                $inserted_ID = Connection::connect()-> lastInsertId();

                $activity_type  = "Business Settings Added";
                $activity = "Business Settings Entry with id ".$inserted_ID;
                // create an activity
                $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity ));

                $newPDO -> commit();

                return $stmt;
            }

        } catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }


    //check if branch already exist
    static public function checkBranch($tbl, $owner, $branch_name){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE branch_name = :bn AND data_owner = :brn LIMIT 1");
        $stmt->bindParam('bn', $branch_name, PDO::PARAM_STR);
        $stmt->bindParam('brn', $owner, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;

    }

    static public function addBranch($tbl, $data){
        $stmt   = Connection::connect()->prepare("INSERT INTO $tbl (branch_name, branch_address, branch_location, addedBy) 
            VALUES (?, ?, ?, ?)");
        $stmt->execute(array(
            $data['bn'],
            $data['ba'],
            $data['bl'],
            $data['adb'],
        ));

        return $stmt;
    }
}
<?php

session_start();
class AddNewStoreCtr
{
    static public function createNewStore(){
        $getToken   = strip_tags(trim($_POST['tkn']));
        $error  = false;
        if (isset($_SESSION['setStoreTkn']) && $_SESSION['setStoreTkn'] == $getToken){
            require_once ('../../model/pos/SaveNewStore.php');
            $tbl    = "pos_store";

            $store_code     = strip_tags(trim($_POST['store_code']));
            $store_name     = strip_tags(trim($_POST['store_name']));
            $store_physical_location    = strip_tags(trim($_POST['store_physical_location']));
            $defaultCurr    = strip_tags(trim($_POST['defaultCurr']));
            $addedBy        = $_SESSION['uid'];
            $branchName     = $_SESSION['branch_name'];

            if (empty($store_code)){
                $error  = true;
                echo "<span style='color: #fff;'>Store Code cannot be empty</span>";
            }
            elseif (empty($store_name)){
                $error  = true;
                echo "<span style='color: #fff;'>Store Name cannot be empty</span>";
            }
            elseif (empty($store_physical_location)){
                $error  = true;
                echo "<span style='color: #fff;'>Store Physical Location cannot be empty</span>";
            }
            elseif (empty($defaultCurr)){
                $error  = true;
                echo "<span style='color: #fff;'>Default Currency cannot be empty</span>";
            }

            //check if store exist

            //checkIfStoreExist($tbl, $data)
            $dt     = array(
              'stn'=> $store_name,
              'spl' => $store_physical_location
            );

            $checkRst   = SaveNewStore::checkIfStoreExist($tbl, $dt);
            $cntRst     = $checkRst->rowCount();
            if ($cntRst > 0){
                $error  = true;
                echo "<span style='color: #fff;'>Shop Entries already exist</span>";
            }

            if (!$error){
                $data   = array(
                    'stc'=> $store_code,
                    'stn' => $store_name,
                    'spl' => $store_physical_location,
                    'dcr' => $defaultCurr,
                    'adb' => $addedBy,
                    'brn' => $branchName
                );

                if (SaveNewStore:: CreateThisStore($tbl, $data)){
                    echo "<span style='color: #fff;'>Entry Successful</span>";
                }
                else{
                    echo "<span style='color: #fff;'>Entry Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #fff;'>Action Not Permitted</span>";
        }
    }
}

$callClass  = new AddNewStoreCtr();
$callMethod = $callClass->createNewStore();
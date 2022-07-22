<?php

session_start();
class ChangeThisStoreStatusCtr
{
    static public function editStoreStatus(){
        $getToken   = strip_tags(trim($_POST['tkn']));
        $error  = false;
        if (isset($_SESSION['editShopToken']) && $_SESSION['editShopToken'] == $getToken){
            require_once('../model/SaveNewStore.php');
            
            $tbl    = "pos_store";
            $tbl_b  = "sales_persons";
            $tbl_c  = "users";
            
            $shop_ID        = strip_tags(trim($_POST['shop_ID']));
            $shop_status    = strip_tags(trim($_POST['shop_status']));
            
            $addedBy        = $_SESSION['uid'];
            $branchName     = $_SESSION['branch_name'];
            $merchant_ID    = $_SESSION['merchant_ID'];

            if (empty($shop_status)){
                $error  = true;
                echo "<span style='color: #fff;'>Store Status cannot be empty</span>";
            }
           
           $lastUpdateOn = Date('Y-m-d');

            if (!$error){
                $data   = array(
                    'sd' => $shop_ID,
                    'sst' => $shop_status,
                    'adb' => $addedBy,
                    'md' => $merchant_ID,
                    'lbn' => $lastUpdateOn
                );

                if (SaveNewStore:: updateThisStoreStatus($tbl, $tbl_b, $tbl_c, $data)){
                    echo "<span style='color: #fff;'>Update Successful</span>";
                }
                else{
                    echo "<span style='color: #fff;'>Update Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #fff;'>Action Not Permitted</span>";
        }
    }
}

ChangeThisStoreStatusCtr::editStoreStatus();
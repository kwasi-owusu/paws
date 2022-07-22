<?php

session_start();
class EditThisStoreCtr
{
    static public function editStore(){
        $getToken   = strip_tags(trim($_POST['tkn']));
        $error  = false;
        if (isset($_SESSION['editShopToken']) && $_SESSION['editShopToken'] == $getToken){
            require_once('../model/SaveNewStore.php');
            
            $tbl    = "pos_store";
            
            $store_code     = strip_tags(trim($_POST['store_code']));
            $store_name     = strip_tags(trim($_POST['store_name']));
            $store_physical_location    = strip_tags(trim($_POST['store_physical_location']));
            $defaultCurr    = strip_tags(trim($_POST['defaultCurr']));
            $shop_ID        = strip_tags(trim($_POST['shop_ID']));
            
            $addedBy        = $_SESSION['uid'];
            $branchName     = $_SESSION['branch_name'];
            $merchant_ID    = $_SESSION['merchant_ID'];

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

           $lastUpdateOn = Date('Y-m-d');

            if (!$error){
                $data   = array(
                    'stc'=> $store_code,
                    'stn' => $store_name,
                    'spl' => $store_physical_location,
                    'sd' => $shop_ID,
                    'dcr' => $defaultCurr,
                    'adb' => $addedBy,
                    'md' => $merchant_ID,
                    'lbn' => $lastUpdateOn
                );

                if (SaveNewStore:: updateThisStore($tbl, $data)){
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

EditThisStoreCtr::editStore();
<?php

session_start();
class AddInventoryCategory
{
    public static function saveInventoryCategory(){
        require_once ('../model/InventoryModel.php');
        require_once ('../model/FetchAllInventoryCategory.php');
        $error = false;
        $tkn    = trim($_POST['tkn']);
        if (isset($_SESSION['inventory_control_token']) && $_SESSION['inventory_control_token'] == $tkn){
            $cat_name   = trim($_POST['cat_name']);
            $cat_desc = trim($_POST['cat_desc']);
            $tbl        = 'inventory_cat';
            $merchant_ID = $_SESSION['merchant_ID'];

            if (empty($cat_name)){
                $error = true;
                echo "Category name cannot be empty";
            }
            elseif (empty($cat_desc)){
                $error = true;
                echo "Category Description cannot be empty";
            }

            // check if category name already exists
            $check_this_name = FetchAllInventoryCategory::checkThisInventoryCategoryName($tbl, $cat_name);
            if($check_this_name > 0) {
                $error = true;
                echo "Category name already exists";
            }

            elseif (!$error){
                
                $addedBy    = $_SESSION['uid'];
                $data = array(
                    'ctn'=>$cat_name,
                    'ctd'=>$cat_desc,
                    'adb'=>$addedBy,
                    'md'=> $merchant_ID
                );

                if (InventoryModel::addCategory($tbl, $data)){
                    echo "Entry Successful.";
                } else {
                    echo "Entry Unsuccessful";
                }
            }
        }
        else{
            echo "Sorry. Action not permitted";
        }
    }
}

$callClass      = new AddInventoryCategory();
$callMethod     = $callClass->saveInventoryCategory();
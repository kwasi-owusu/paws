<?php

session_start();
class InventorySubCategories
{
    public static function addSubCategories(){
        require_once ('../model/InventoryModel.php');
        $getToken   = trim($_POST['tkn']);
        $error      = false;
        if (isset($_SESSION['inventory_control_token']) && $_SESSION['inventory_control_token'] == $getToken){
            $sub_cat    = trim($_POST['sub_cat_name']);
            $catName    = trim($_POST['inventory_cat']);
            if (empty($sub_cat)){
                $error  = true;
                echo "Sub category name cannot be empty";
            }
            elseif (!$error){
                $tbl        = 'inventory_sub_cat';
                $addedBy    = $_SESSION['uid'];
                $merchant_ID = $_SESSION['merchant_ID'];
                $data       = array(
                    'sbc'=>$sub_cat,
                    'cn'=>$catName,
                    'adb'=>$addedBy,
                    'md' =>$merchant_ID
                );
                if (InventoryModel::addSubCategory($tbl, $data)){
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
InventorySubCategories::addSubCategories();
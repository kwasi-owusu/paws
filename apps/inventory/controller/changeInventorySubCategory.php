<?php

session_start();
class ChangeInventorySubCategory
{
    public static  function editSubCategory(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;
        if (isset($_SESSION['editInventorySubCategory']) && $_SESSION['editInventorySubCategory'] == $getToken){
            $cat_ID         = trim($_POST['inventory_cat']);
            $sub_cat_ID     = trim($_POST['sub_cat_ID']);
            $sub_cat_name   = trim($_POST['sub_cat_name']);


            if (empty($sub_cat_name)){
                $error  = true;
                echo "<span style='color: #bd0f09'>Sub Category cannot be empty</span>";
            }

            elseif (!$error){
                require_once ('../model/EditInventorySubCategoryByID.php');
                $tbl    = 'inventory_sub_cat';
                $data   = array(
                    'cid'=>$cat_ID,
                    'sn'=>$sub_cat_name,
                    'scd'=>$sub_cat_ID
                );
                if (EditInventorySubCategoryByID::editSubCatByID($tbl, $data)){
                    echo "<span style='color: #1b901d'>Update Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Update Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #b9090e'>Action not Permitted</span >";
        }
    }
}

ChangeInventorySubCategory::editSubCategory();
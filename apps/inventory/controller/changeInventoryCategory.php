<?php

session_start();
class changeInventoryCategory
{
    static public function editCategory(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;
        if (isset($_SESSION['editInventoryCategory']) && $_SESSION['editInventoryCategory'] == $getToken){
            $cat_ID     = trim($_POST['cat_ID']);
            $cat_name   = trim($_POST['cat_name']);
            $cat_desc   = trim($_POST['cat_desc']);

            if (empty($cat_name)){
                $error  = true;
                echo "<span style='color: #bd0f09'>Category cannot be empty</span>";
            }
            elseif (empty($cat_desc)){
                $error  = true;
                echo "<span style='color: #bd0f09'>Category Description cannot be empty</span>";
            }

            elseif (!$error){
                require_once ('../../model/inventory/EditInventoryCategoryByID.php');
                $tbl    = 'inventory_cat';
                $data   = array(
                    'id'=>$cat_ID,
                    'cn'=>$cat_name,
                    'cd'=>$cat_desc
                );
                if (EditInventoryCategoryByID::editCatByID($tbl, $data)){
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
$callClass  = new changeInventoryCategory();
$callMethod = $callClass->editCategory();
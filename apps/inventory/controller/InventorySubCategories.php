<?php

session_start();
class InventorySubCategories
{
    static public function addSubCategories(){
        require_once ('../../model/inventory/InventoryModel.php');
        $getToken   = trim($_POST['tkn']);
        $error      = false;
        if (isset($_SESSION['inventorySubCategoryToken']) && $_SESSION['inventorySubCategoryToken'] == $getToken){
            $sub_cat    = trim($_POST['sub_cat_name']);
            $catName    = trim($_POST['inventory_cat']);
            if (empty($sub_cat)){
                $error  = true;
                echo "<span style='color: #b9090e'>Sub category name cannot be empty/span>";
            }
            elseif (!$error){
                $tbl        = 'inventory_sub_cat';
                $addedBy    = 1;
                $data       = array(
                    'sbc'=>$sub_cat,
                    'cn'=>$catName,
                    'adb'=>$addedBy
                );
                if (InventoryModel::addSubCategory($tbl, $data)){
                    echo "<span style='color: #1b901d'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Entry Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #b9090e'>Sorry. Action not permitted</span>";
        }
    }
}
$callClass  = new InventorySubCategories();
$callMetho  = $callClass->addSubCategories();
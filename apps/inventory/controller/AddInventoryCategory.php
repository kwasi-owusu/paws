<?php

session_start();
class AddInventoryCategory
{
    static public function saveInventoryCategory(){
        require_once ('../../model/inventory/InventoryModel.php');
        $error = false;
        $tkn    = trim($_POST['tkn']);
        if (isset($_SESSION['inventoryCategoryToken']) && $_SESSION['inventoryCategoryToken'] == $tkn){
            $cat_name   = trim($_POST['cat_name']);
            $cat_desc = trim($_POST['cat_desc']);

            if (empty($cat_name)){
                $error = true;
                echo "<span style='color: #b9090e'>Category name cannot be empty</span>";
            }
            elseif (empty($cat_desc)){
                $error = true;
                echo "<span style='color: #b9090e'>Category Description cannot be empty</span>";
            }

            elseif (!$error){
                $tbl        = 'inventory_cat';
                $addedBy    = '1';
                $data = array(
                    'ctn'=>$cat_name,
                    'ctd'=>$cat_desc,
                    'adb'=>$addedBy
                );

                if (InventoryModel::addCategory($tbl, $data)){
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

$callClass      = new AddInventoryCategory();
$callMethod     = $callClass->saveInventoryCategory();
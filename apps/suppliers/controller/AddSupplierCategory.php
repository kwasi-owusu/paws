<?php
session_start();

class AddSupplierCategory
{
    static public function addNewSupplier(){
        $tkn       = trim($_POST['categoryTkn']);
        $error = false;
        if (isset($_SESSION['getSupplierCategoryToken']) && $_SESSION['getSupplierCategoryToken'] == $tkn){
            $categoryName   = trim($_POST['categoryName']);
            $categoryDesc   = trim($_POST['categoryDesc']);

            if (empty($categoryName)){
                $error = true;
                echo "<span style='color: #b9090e'>Category Name Cannot be empty</span >";
            }
            elseif (empty($categoryDesc)){
                $error = true;
                echo "<span style='color: #b9090e'>Category Description Cannot be empty</span >";
            }

            elseif (!$error){
                require_once('../../model/suppliers/SuppliersModel.php');
                $tbl    = 'suppliercategories';
                $added_by = '1';
                $data   = array(
                    'cn'=>$categoryName,
                    'ctd'=>$categoryDesc,
                    'adb'=>$added_by

                );
                if (SuppliersModel::addNewCategory($tbl, $data)){
                    echo "<span style='color: #1b901d'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Entry Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #b9090e'>Action not Permitted</span > ".$_SESSION['getSupplierCategoryToken'];
        }
    }
}
$callMethod     = new AddSupplierCategory();
$thisMethod     = $callMethod->addNewSupplier();
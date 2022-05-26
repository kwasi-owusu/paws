<?php

session_start();
class UpdateSupplierCatController
{
    static public function updateCategory(){
        $tkn    = trim($_POST['categoryTkn']);
        $error = false;
        if (isset($_SESSION['editSupplierCatToken']) && $_SESSION['editSupplierCatToken'] = $tkn){
            $cat_name   = trim($_POST['categoryName']);
            $cat_ID     = trim($_POST['cat_ID']);
            $cat_desc   = trim($_POST['categoryDesc']);

            if (empty($cat_name)){
             $error = true;
                    echo "<span style='color: #b9090e'>Category Name cannot be empty</span>";
            }
            elseif (empty($cat_desc)){
                $error = true;
                    echo "<span style='color: #b9090e'>Category Description cannot be empty</span>";
            }
            elseif (!$error){
                require_once('../../model/suppliers/UpdateSupplierCategoryModel.php');
                $tbl            = 'suppliercategories';
                $lastUpdateBy   = 1;
                $lastUpdateOn   = Date('Y-m-d');
                $data   = array(
                  'cn'=>$cat_name,
                  'cde'=>$cat_desc,
                  'lb'=>$lastUpdateBy,
                  'ln'=>$lastUpdateOn,
                  'cd'=>$cat_ID
                );
                if (UpdateSupplierCategoryModel::updateThisSupplierCat($tbl, $data)){
                    echo "<span style='color: #1b901d'>Update Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Update Unsuccessful</span>";
                }
            }
        }
        else{
                echo "<span style='color: #b9090e'>Sorry. Action not permitted</span>";
            }
    }
}


$callMethod     = new UpdateSupplierCatController();
$thisMethod     = $callMethod->updateCategory();
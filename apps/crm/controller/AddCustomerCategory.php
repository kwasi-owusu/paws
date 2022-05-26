<?php
session_start();

class AddCustomerCategory
{
    static public function AddCustomerCategoryController(){
        require_once ('../../model/crm/CustomerModel.php');
        $tkn = trim($_POST['customer_cat_tkn']);
        $error = false;
        if (isset($_SESSION['customer_cat_cors']) && $_SESSION['customer_cat_cors'] == $tkn){
            $cat_name       = trim($_POST['cat_name']);
            $cat_desc       = trim($_POST['cat_desc']);
            if (empty($cat_name)){
                $error = true;
                echo "<span style='color: #b9090e'>Category Name Field cannot be empty</span>";
            }
            elseif (empty($cat_desc)){
                $error = true;
                echo "<span style='color: #b9090e'>Category Description field cannot be empty</span>";
            }
            elseif (!$error){
                $added_by   = '1';
                $tblName    = 'customercategories';
                $data       = array(
                    'cn'=>$cat_name,
                    'cd'=>$cat_desc,
                    'adb'=>$added_by
                );
                if (CustomerModel::addCustomerCategory($tblName, $data)){
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

$callMethod     = new AddCustomerCategory();
$thisMethod     = $callMethod->AddCustomerCategoryController();
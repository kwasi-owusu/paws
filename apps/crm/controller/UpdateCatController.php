<?php

session_start();
class UpdateCatController
{
    static public function editThisCat(){
        require_once('../../model/crm/EditCat.php');
        $tkn = trim($_POST['customer_cat_tkn']);
        $error = false;
        if (isset($_SESSION['editCatToken']) && $_SESSION['editCatToken'] == $tkn){
            $cat_name       = trim($_POST['cat_name']);
            $cat_ID         = trim($_POST['cat_ID']);
            $cat_desc       = trim($_POST['cat_desc']);

            if (empty($cat_name)){
                $error = true;
                echo "<span style='color: #b9090e'>Category Name Cannot be empty</span >";
            }

            elseif (empty($cat_desc)){
                $error = true;
                echo "<span style='color: #b9090e'>Category Description Cannot be empty</span >";
            }

            elseif (!$error){
                $tbl            = 'customercategories';
                $lastUpdateBy   = '1';
                $lastUpdateOn   = Date('Y-m-d');
                $data           = array(
                    'cd' => $cat_ID,
                    'cn'=>$cat_name,
                    'cds'=>$cat_desc,
                    'ln'=>$lastUpdateOn,
                    'lb'=>$lastUpdateBy
                );
                if (EditCat::editCustomerCat($tbl, $data)){
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

$callMethod     = new UpdateCatController();
$thisMethod     = $callMethod->editThisCat();
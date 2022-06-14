<?php

session_start();
class UpdateCustomerDetailsController
{
    public static function updateCustomerDetails(){

        require_once ('../model/CustomerModel.php');

        $tkn = trim($_POST['tkn']);
       
        if (isset($_SESSION['editCustomerToken']) && $_SESSION['editCustomerToken'] == $tkn){
            $customer_ID        = trim($_POST['customer_ID']);
            //$cust_cat           = trim($_POST['cust_cat']);
            $customa_name       = trim($_POST['customa_name']);
            $CCCode             = trim($_POST['CCCode']);
            $customa_email      = trim($_POST['customa_email']);
            $customa_phone      = trim($_POST['customa_phone']);
            $customa_address    = trim($_POST['customa_address']);
            $contact_person     = trim($_POST['contact_person']);
            $contact_person_phone     = trim($_POST['contact_person_phone']);

            $error = false;

            if (empty($cust_cat)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer Category cannot be empty</span>";
            }

            elseif ($cust_cat == '999'){
                $error = true;
                echo "<span style='color: #b9090e'>Please Select Customer Category</span>";
            }

            elseif (empty($customa_name)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer Name cannot be empty</span>";
            }


            elseif (empty($customa_phone)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer Phone cannot be empty</span>";
            }


            elseif (empty($customa_address)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer Address cannot be empty</span>";
            }

            elseif (empty($contact_person)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact Person cannot be empty</span>";
            }

            elseif (empty($contact_person_phone)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact Person Phone cannot be empty</span>";
            }
            elseif (!$error){
                $lastUpdateBy   = '1';
                $lastUpdateOn   = Date('Y-m-d');
                $tblName    = 'customers';
                $data       = array(
                    'cd'=>$customer_ID,
                    'cc'=>$cust_cat,
                    'cn'=>$customa_name,
                    'ccd'=>$CCCode,
                    'ce'=>$customa_email,
                    'cp'=>$customa_phone,
                    'cad'=>$customa_address,
                    'cps'=>$contact_person,
                    'cpsp'=>$contact_person_phone,
                    'ln'=>$lastUpdateOn,
                    'lb'=>$lastUpdateBy
                );
                if (CustomerModel::editCustomer($tblName, $data)){
                    echo "<span style='color: #1b901d'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Entry Unsuccessful</span>";
                }
            }



        }
        else{
            echo "<span>Sorry. Action not permitted</span>";
        }

    }
}

UpdateCustomerDetailsController::updateCustomerDetails();
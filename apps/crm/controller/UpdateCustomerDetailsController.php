<?php

session_start();
class UpdateCustomerDetailsController
{
    public static function updateCustomerDetails(){
        require_once ('../model/CustomerModel.php');
        $tkn = trim($_POST['tkn']);
       
        if (isset($_SESSION['editCustomerToken']) && $_SESSION['editCustomerToken'] == $tkn){
            $customer_ID        = trim($_POST['customer_ID']);
            $customa_name       = trim($_POST['customa_name']);
            $CCCode             = trim($_POST['CCCode']);
            $customa_email      = trim($_POST['customa_email']);
            $customa_phone      = trim($_POST['customa_phone']);
            $customa_address    = trim($_POST['customer_address']);
            
            $error = false;

            if (empty($customa_name)){
                $error = true;
                echo "<span>Customer Name cannot be empty</span>";
            }


            elseif (empty($customa_phone)){
                $error = true;
                echo "<span>Customer Phone cannot be empty</span>";
            }


            elseif (empty($customa_address)){
                $error = true;
                echo "<span>Customer Address cannot be empty</span>";
            }

           
            elseif (!$error){
                $lastUpdateBy   = $_SESSION['uid'];
                $lastUpdateOn   = Date('Y-m-d');
                $tblName    = 'customers';

                $data       = array(
                    'cd'=>$customer_ID,
                    'cn'=>$customa_name,
                    'ccd'=>$CCCode,
                    'ce'=>$customa_email,
                    'cp'=>$customa_phone,
                    'cad'=>$customa_address,
                    'ln'=>$lastUpdateOn,
                    'lb'=>$lastUpdateBy
                );
                if (CustomerModel::editCustomer($tblName, $data)){
                    echo "<span>Entry Successful.</span>";
                } else {
                    echo "<span>Entry Unsuccessful</span>";
                }
            }



        }
        else{
            echo "<span>Sorry. Action not permitted</span>";
        }

    }
}

UpdateCustomerDetailsController::updateCustomerDetails();
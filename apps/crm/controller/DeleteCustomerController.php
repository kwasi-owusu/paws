<?php

session_start();

class DeleteCustomerController{
    public static function deleteCustomer(){

        require_once ('../model/CustomerModel.php');
        $tkn = trim($_POST['tkn']);
       
        if (isset($_SESSION['deleteCustomerToken']) && $_SESSION['deleteCustomerToken'] == $tkn){
            $customer_ID        = trim($_POST['customer_ID']);
            $delete_by          = $_SESSION['uid'];
            $tbl                = 'customers';

            $data = array(
                'cd'=> $customer_ID,
                'lbd'=> $delete_by
            );

            if(CustomerModel::deleteThisCustomerSoftly($tbl, $data)){
                echo 'Customer Deleted successfully';
            }

            else{
                echo 'Customer Delete unsuccessful';
            }

        }
    }
}

DeleteCustomerController::deleteCustomer();
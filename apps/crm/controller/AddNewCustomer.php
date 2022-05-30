<?php

session_start();
class AddNewCustomer
{
    public static function addNewCustomerController()
    {
        require_once('../model/CustomerModel.php');
        $tkn = trim($_POST['tkn']);
        $error = false;
        if (isset($_SESSION['addCustomerTkn']) && $_SESSION['addCustomerTkn'] == $tkn) {
            $customa_name       = strip_tags(trim($_POST['customa_name']));
            $CCCode             = strip_tags(trim($_POST['CCCode']));
            $customa_email      = strip_tags(trim($_POST['customa_email']));
            $customa_phone      = strip_tags(trim($_POST['customa_phone']));
            $contact_person_fname     = strip_tags(trim($_POST['contact_person_fname']));
            $contact_person_lname     = strip_tags(trim($_POST['contact_person_lname']));
            $contact_person_email     = strip_tags(trim($_POST['contact_person_email']));
            $contact_person_phone     = strip_tags(trim($_POST['contact_person_phone']));

            ############## customer address ############
            $customer_address       = strip_tags(trim($_POST['customer_address']));
            $town_city              = strip_tags(trim($_POST['town_city']));
            $state                  = strip_tags(trim($_POST['state']));
            $country                = strip_tags(trim($_POST['country']));

            if (empty($customa_name)) {
                $error = true;
                echo "<span>Customer Name cannot be empty</span>";
            } elseif (empty($CCCode)) {
                $error = true;
                echo "<span>Customer Code cannot be empty</span>";
            } elseif (empty($customa_phone)) {
                $error = true;
                echo "<span>Customer Phone cannot be empty</span>";
            } elseif (empty($customer_address)) {
                $error = true;
                echo "<span>Customer Address cannot be empty</span>";
            } elseif (!$error) {
                //generate key for customer
                $customerKey = hash_hmac('sha512', $customa_name, $CCCode);

                $added_by       = $_SESSION['uid'];
                $merchant_ID    = $_SESSION['merchant_ID'];
                $tbl        = 'customers';
                $data       = array(
                    'cn' => $customa_name,
                    'ccd' => $CCCode,
                    'ce' => $customa_email,
                    'cp' => $customa_phone,
                    'cad' => $customer_address,
                    'cfn' => $contact_person_fname,
                    'cln' => $contact_person_lname,
                    'cph' => $contact_person_phone,
                    'adb' => $added_by,
                    'cpe' => $contact_person_email,
                    'ck' => $customerKey,
                    'tc' => $town_city,
                    'st' => $state,
                    'cty' => $country,
                    'md'=> $merchant_ID
                );
                if (CustomerModel::addNewCustomer($tbl, $data)) {
                    echo "<span>Entry Successful.</span>";
                } else {
                    echo "<span>Entry Unsuccessful</span>";
                }
            }
        } else {
            echo "<span style='color: #b9090e'>Sorry. Action not permitted</span>";
        }
    }
}

AddNewCustomer::addNewCustomerController();

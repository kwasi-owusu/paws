<?php

session_start();
class AddNewCustomer
{
    static public function addNewCustomerController(){
        require_once ('../../model/crm/CustomerModel.php');
        $tkn = trim($_POST['tkn']);
        $error = false;
        if (isset($_SESSION['customer_ors']) && $_SESSION['customer_ors'] == $tkn){
            $cust_cat           = trim($_POST['cust_cat']);
            $customa_name       = trim($_POST['customa_name']);
            $CCCode             = trim($_POST['CCCode']);
            $customa_email      = trim($_POST['customa_email']);
            $customa_phone      = trim($_POST['customa_phone']);
            $contact_person     = trim($_POST['contact_person']);
            $contact_person_phone     = trim($_POST['contact_person_phone']);

            ############## customer address ############
            $customer_address       = strip_tags(trim($_POST['customer_address']));
            $customer_address_b     = strip_tags(trim($_POST['customer_address_b']));
            $town_city              = strip_tags(trim($_POST['town_city']));
            $state                  = strip_tags(trim($_POST['state']));
            $country                = strip_tags(trim($_POST['country']));

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

            elseif (empty($CCCode)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer Code cannot be empty</span>";
            }

            elseif (empty($customa_phone)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer Phone cannot be empty</span>";
            }


            elseif (empty($customer_address)){
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
                //generate key for customer
                $customerKey = hash_hmac('sha512', $customa_name, $CCCode);

                $added_by   = $_SESSION['uid'];
                $tblName    = 'customers';
                $data       = array(
                    'cc'=>$cust_cat,
                    'cn'=>$customa_name,
                    'ccd'=>$CCCode,
                    'ce'=>$customa_email,
                    'cp'=>$customa_phone,
                    'cad'=>$customer_address,
                    'cps'=>$contact_person,
                    'cpsp'=>$contact_person_phone,
                    'adb'=>$added_by,
                    'ck'=>$customerKey,
                    'cad_b'=> $customer_address_b,
                    'tc'=> $town_city,
                    'st'=> $state,
                    'cty'=> $country
                );
                if (CustomerModel::addNewCustomer($tblName, $data)){
                    echo "<span style='color: #ffffff'>Entry Successful.</span>";
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

$callMethod     = new AddNewCustomer();
$thisMethod     = $callMethod->addNewCustomerController();
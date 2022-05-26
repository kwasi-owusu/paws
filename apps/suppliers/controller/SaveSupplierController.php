<?php

session_start();
class SaveSupplierController
{
    static public function saveSupplier(){
        $tkn    = trim($_POST['tkn']);
        $error = false;
        if (isset($_SESSION['setSupplierCors']) && $_SESSION['setSupplierCors'] == $tkn){
            $supplier_code      = trim($_POST['supplier_code']);
            $SupplCat           = trim($_POST['SupplCat']);
            $supp_name          = trim($_POST['supp_name']);
            $supp_phone         = trim($_POST['supp_phone']);
            $address1           = trim($_POST['address1']);
            $contact_person     = trim($_POST['contact_person']);
            $contact_person_phone = trim($_POST['contact_person_phone']);
            $supp_email         = trim($_POST['supp_email']);
            $town_city          = trim($_POST['town_city']);
            $state_region       = trim($_POST['state_region']);
            $country            = trim($_POST['country']);

            if (empty($supp_name)){
                $error = true;
                echo "<span style='color: #b9090e'>Supplier name cannot be empty</span>";
            }
            elseif (empty($supp_phone)){
                $error = true;
                echo "<span style='color: #b9090e'>Supplier Phone cannot be empty</span>";
            }
            elseif (empty($address1)){
                $error = true;
                echo "<span style='color: #b9090e'>Supplier Address cannot be empty</span>";
            }
            elseif (empty($contact_person)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact person cannot be empty</span>";
            }
            elseif (empty($contact_person_phone)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact person phone cannot be empty</span>";
            }
            elseif (empty($town_city)){
                $error = true;
                echo "<span style='color: #b9090e'>Town/City phone cannot be empty</span>";
            }
            elseif (empty($state_region)){
                $error = true;
                echo "<span style='color: #b9090e'>State/Region phone cannot be empty</span>";
            }

            elseif (!$error){
                require_once('../../model/suppliers/SuppliersModel.php');
                $tbl        = 'suppliers';
                $supplier_Key = hash_hmac('sha512', $supp_name, $supplier_code);
                $addedBy    = $_SESSION['uid'];
                $data       = array(
                    'spn'=>$supp_name,
                    'nspn' => $supp_name,
                    'sup_cat'=>$SupplCat,
                    'sph'=>$supp_phone,
                    'spc'=>$supplier_code,
                    'spe'=>$supp_email,
                    'spcp'=>$contact_person,
                    'spcph'=>$contact_person_phone,
                    'spad'=>$address1,
                    'adb'=>$addedBy,
                    'sk'=>$supplier_Key,
                    'tc'=>$town_city,
                    'str'=>$state_region,
                    'cntr'=>$country
                );
                if(SuppliersModel::addNewSupplier($tbl, $data)){
                    echo "<span style='color: #1b901d'>Entry Successful.</span>";
                }
                else {
                    echo "<span style='color: #b9090e'>Entry Unsuccessful</span>";
                }
            }

        }
        else{
            echo "<span style='color: #b9090e'>Sorry. Action not permitted</span>";
        }
    }
}

$callClass  = new SaveSupplierController();
$callMeth   = $callClass->saveSupplier();
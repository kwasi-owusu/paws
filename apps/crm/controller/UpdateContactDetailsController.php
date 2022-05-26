<?php

session_start();
class UpdateContactDetailsController
{
    static public function editContactDetails(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;

        if (isset($_SESSION['contactEdit']) && $_SESSION['contactEdit'] == $getToken){
            $contact_type   = trim($_POST['contact_type']);
            $contact_name   = trim($_POST['contact_name']);
            $contact_email  = trim($_POST['contact_email']);
            $contact_phone  = trim($_POST['contact_phone']);
            $company_name   = trim($_POST['company_name']);
            $contact_position   = trim($_POST['contact_position']);
            $contact_notes  = trim($_POST['contact_notes']);
            $contact_ID     = trim($_POST['contact_ID']);

            if (empty($contact_name)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact Name Cannot be empty</span >";
            }

            elseif (empty($contact_email)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact Email Cannot be empty</span >";
            }

            elseif (empty($contact_phone)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact Phone Cannot be empty</span >";
            }

            elseif (empty($contact_notes)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact Notes Cannot be empty</span >";
            }

            elseif (!$error){
                require_once ('../../model/crm/CustomerModel.php');
                $tbl    = 'contact_tbl';
                $lastUpdateBy   = $_SESSION['uid'];
                $lastUpdateOn   = Date('Y-m-d');
                $data   = array(
                    'ct'=>$contact_type,
                    'cn'=>$contact_name,
                    'ce'=>$contact_email,
                    'cp'=>$contact_phone,
                    'con'=>$company_name,
                    'cpo'=>$contact_position,
                    'nts'=>$contact_notes,
                    'lb'=>$lastUpdateBy,
                    'ln'=>$lastUpdateOn,
                    'cid'=>$contact_ID
                );

                if (CustomerModel::editContact($tbl, $data)){
                    echo "<span style='color: #1b901d'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Entry Unsuccessful</span>";
                }
            }

        }
        else{
            echo "<span style='color: #b9090e'>Action not Permitted</span >";
        }
    }
}

$callClass  = new UpdateContactDetailsController();
$callMethod = $callClass->editContactDetails();
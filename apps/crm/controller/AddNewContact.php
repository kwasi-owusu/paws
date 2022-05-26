<?php

session_start();
class AddNewContact
{
    static public function addContact(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;

        if (isset($_SESSION['contact_cors']) && $_SESSION['contact_cors'] == $getToken){
            $contact_type   = strip_tags(trim($_POST['contact_type']));
            $contact_name   = strip_tags(trim($_POST['contact_name']));
            $contact_email  = strip_tags(trim($_POST['contact_email']));
            $contact_phone  = strip_tags(trim($_POST['contact_phone']));
            $company_name   = strip_tags(trim($_POST['company_name']));
            $contact_position   = strip_tags(trim($_POST['contact_position']));
            $contact_notes  = strip_tags(trim($_POST['contact_notes']));


            if (empty($contact_name)){
                $error = true;
                echo "<span style='color: #ffffff'>Contact Name Cannot be empty</span >";
            }

            elseif (empty($contact_email)){
                $error = true;
                echo "<span style='color: #ffffff'>Contact Email Cannot be empty</span >";
            }

            elseif (empty($contact_phone)){
                $error = true;
                echo "<span style='color: #ffffff'>Contact Phone Cannot be empty</span >";
            }

            elseif (empty($contact_notes)){
                $error = true;
                echo "<span style='color: #ffffff'>Contact Notes Cannot be empty</span >";
            }

            elseif (!$error){
                require_once('../../model/crm/CustomerModel.php');
                $tbl    = 'contact_tbl';
                $addedBy    = $_SESSION['uid'];
                $data_owner     = $_SESSION['data_owner'];
                $data   = array(
                    'ct'=>$contact_type,
                    'cn'=>$contact_name,
                    'ce'=>$contact_email,
                    'cp'=>$contact_phone,
                    'con'=>$company_name,
                    'cpo'=>$contact_position,
                    'nts'=>$contact_notes,
                    'adb'=>$addedBy,
                    'dow'=> $data_owner


                );

                if (CustomerModel::addNewContact($tbl, $data)){
                    echo "<span style='color: #ffffff'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #ffffff'>Entry Unsuccessful</span>";
                }
            }

        }
        else{
            echo "<span style='color: #ffffff'>Action not Permitted</span >";
        }
    }
}

$callClass  = new AddNewContact();
$callMethod = $callClass->addContact();
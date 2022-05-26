<?php

session_start();
class AddNewContact
{
    static public function addContact(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;

        if (isset($_SESSION['contact_cors']) && $_SESSION['contact_cors'] == $getToken){
            
            $contact_firstName      = strip_tags(trim($_POST['firstName']));
            $contact_lastName       = strip_tags(trim($_POST['lastName']));

            $contact_email          = strip_tags(trim($_POST['contact_email']));
            $contact_phone          = strip_tags(trim($_POST['contact_phone']));
            
            $company_name           = strip_tags(trim($_POST['company_name']));
            $job_title              = strip_tags(trim($_POST['job_title']));

            $contact_notes          = strip_tags(trim($_POST['contact_notes']));

            $key_details = $contact_email."-".$contact_phone;

            $contactKey = hash_hmac('sha512', $key_details, $contact_email);


            if (empty($contact_firstName)){
                $error = true;
                echo "<span>First Name Cannot be empty</span >";
            }

            else if (empty($contact_lastName)){
                $error = true;
                echo "<span>Last Name Cannot be empty </span >";
            }

            elseif (empty($contact_email)){
                $error = true;
                echo "<span>Contact Email Cannot be empty</span >";
            }

            elseif (empty($contact_phone)){
                $error = true;
                echo "<span>Contact Phone Cannot be empty</span >";
            }

            elseif (empty($contact_notes)){
                $error = true;
                echo "<span>Contact Notes Cannot be empty</span >";
            }

            elseif (!$error){
                require_once('../model/ContactsModel.php');
                $tbl    = 'contacts';
                
                $addedBy        = $_SESSION['uid'];
                $merchant_ID    = $_SESSION['merchant_ID'];

                $data   = array(
                    'ck'=>$contactKey,
                    'cfn'=>$contact_firstName,
                    'cln'=>$contact_lastName,
                    'ce'=>$contact_email,
                    'cp'=>$contact_phone,
                    'con'=>$company_name,
                    'jtt'=>$job_title,
                    'nts'=>$contact_notes,
                    'adb'=>$addedBy,
                    'md'=> $merchant_ID
                );

                if (ContactsModel::addNewContact($tbl, $data)){
                    echo "<span style='color:#029'>Entry Successful.</span>";
                } else {
                    echo "<span>Entry Unsuccessful</span>";
                }
            }

        }
        else{
            echo "<span style='color:#000'>Action not Permitted</span >";
        }
    }
}

AddNewContact::addContact();
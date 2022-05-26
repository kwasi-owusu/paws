<?php

session_start();
class UpdateContactDetailsController
{
    static public function editContactDetails(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;

        if (isset($_SESSION['contactEdit']) && $_SESSION['contactEdit'] == $getToken){
            $firstName          = trim($_POST['firstName']);
            $lastName           = trim($_POST['lastName']);
            $contact_email      = trim($_POST['contact_email']);
            $contact_phone      = trim($_POST['contact_phone']);
            $company_name       = trim($_POST['company_name']);
            $job_title          = trim($_POST['job_title']);
            $contact_notes      = trim($_POST['contact_notes']);
            $contact_ID         = trim($_POST['contact_ID']);

            if (empty($firstName)){
                $error = true;
                echo "<span style='color: #b9090e'>First Name Cannot be empty</span >";
            }

            else if (empty($lastName)){
                $error = true;
                echo "<span style='color: #b9090e'>Last Name Cannot be empty</span >";
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
                require_once ('../model/ContactsModel.php');
                $tbl    = 'contacts';
                $lastUpdateBy   = $_SESSION['uid'];
                $lastUpdateOn   = Date('Y-m-d');
                $data   = array(
                    'fnm'=>$firstName,
                    'lnm'=>$lastName,
                    'cem'=>$contact_email,
                    'cph'=>$contact_phone,
                    'cn'=>$company_name,
                    'jt'=>$job_title,
                    'nts'=>$contact_notes,
                    'lbd'=>$lastUpdateBy,
                    'lbn'=>$lastUpdateOn,
                    'cid'=>$contact_ID
                );

                if (ContactsModel::editContact($tbl, $data)){
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
UpdateContactDetailsController::editContactDetails();

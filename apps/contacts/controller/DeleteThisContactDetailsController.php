<?php

session_start();
class DeleteThisContactDetailsController
{
    static public function deleteContactDetails(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;

        if (isset($_SESSION['contactEdit']) && $_SESSION['contactEdit'] == $getToken){
            
            $contact_ID         = trim($_POST['contact_ID']);

            if (!isset($contact_ID)){
                $error = true;
                echo "<span style='color: #b9090e'>Contact Details not admitted. Please try again.</span >";
            }
           

            elseif (!$error){
                require_once ('../model/ContactsModel.php');
                $tbl    = 'contacts';
                $lastUpdateBy   = $_SESSION['uid'];
                $lastUpdateOn   = Date('Y-m-d');
                
                if (ContactsModel::deleteThisContact($tbl, $contact_ID)){
                    echo "<span style='color: #1b901d'>Contact Delete Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Contact Delete Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #b9090e'>Action not Permitted</span >";
        }
    }
}
DeleteThisContactDetailsController::deleteContactDetails();

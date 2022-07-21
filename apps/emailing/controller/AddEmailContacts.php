<?php
session_start();

class AddEmailContacts
{
    public static function uploadEmailContacts()
    {

        $getToken  = trim($_POST['tkn']);
        $error = false;
        $contact_list = '';

        $upload_format  = strip_tags(trim($_POST['upload_format']));



        if (isset($_SESSION['addEmailContactList']) && $_SESSION['addEmailContactList'] == $getToken) {
            if (!isset($_POST['confirm_terms'])) {
                $error = true;
                echo "You can only upload email contacts with the consent of the contacts";

                return;
            } elseif (!isset($upload_format)) {
                $error = true;
                echo "You are required to select an upload format in Step 2";

                return;
            }

            if ($_POST['upload_format'] == "zip_csv_json_upload") {

                $csv_email_content = $_FILES['contactCSVFile'];

                if (!isset($csv_email_content)) {
                    $error = true;
                    echo "Please upload your contact CSV file";
                    return;
                }

                if (isset($_POST['contact_list'])) {

                    if ($_POST['contact_list'] == "as_an_existing_list") {

                        $contact_list .= trim(strip_tags($_POST['select_contact_list']));
                    } elseif ($_POST['contact_list'] == "as_a_new_list") {
                        $contact_list .= trim(strip_tags($_POST['enter_contact_list']));
                    }
                } else {
                    $error = true;
                    echo "Please Assign Contacts in Step 5";
                    return;
                }

                if (!$error) {

                    //call the function in the model for uploading csv


                }
            } else if (isset($_POST['upload_format']) && $_POST['upload_format'] == "paste_email") {

                $pasted_email_list = strip_tags(trim($_POST['email_contact_list']));
                $all_pasted_email_list = explode(',', $pasted_email_list);

                if (!isset($pasted_email_list) || empty($_POST['email_contact_list'])) {
                    $error = true;
                    echo "Please Paste Contacts in Step 3";
                    return;
                }

                if (isset($_POST['contact_list'])) {

                    if ($_POST['contact_list'] == "as_an_existing_list") {

                        $contact_list .= trim(strip_tags($_POST['select_contact_list']));
                    } elseif ($_POST['contact_list'] == "as_a_new_list") {
                        $contact_list .= trim(strip_tags($_POST['enter_contact_list']));
                    }
                } else {
                    $error = true;
                    echo "Please Assign Contacts in Step 5";
                    return;
                }

                if (!$error) {

                    //call the function in the model for looping thru the contacts from textarea


                }
            }
        } else {
            echo "Action not permitted";
        }
    }
}

AddEmailContacts::uploadEmailContacts();

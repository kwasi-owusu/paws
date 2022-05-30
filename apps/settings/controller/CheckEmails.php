<?php

class CheckEmails{
    
    public static function checkThisEmail(){
        $email_to_check = strip_tags(trim($_POST['email']));

        if (isset($email_to_check)){
            $where_to_check = strip_tags(trim($_POST['check_where']));
            require_once '../model/CheckEmailsMdl.php';

            if($where_to_check == "customers"){

                $val    = $email_to_check;
                $getRst = CheckEmailsMdl::checkCustomerEmail($val);

                $cnt_email = $getRst->rowCount();
                if($cnt_email > 0){
                    echo "Email Exists";
                }
                else{
                    echo "Email Not Exists";
                }
            }

            elseif($where_to_check == "users"){
                $val    = $email_to_check;
                $getRst = CheckEmailsMdl::checkUserEmail($val);

                $cnt_email = $getRst->rowCount();
                if($cnt_email > 0){
                    echo "Email Exists";
                }
                else{
                    echo "Email Not Exists";
                }
            }

            elseif($where_to_check == "contacts"){
                $val    = $email_to_check;
                $getRst = CheckEmailsMdl::checkContactEmail($val);

                $cnt_email = $getRst->rowCount();
                if($cnt_email > 0){
                    echo "Email Exists";
                }
                else{
                    echo "Email Not Exists";
                }
            }


        }
    }
}

CheckEmails::checkThisEmail();
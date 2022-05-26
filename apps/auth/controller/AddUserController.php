<?php
session_start();

class AddUserController
{
    static public function addUser(){
        require_once('../model/UserModel.php');
        $tkn = trim($_POST['addUserTkn']);
        $error = false;
        if (isset($_SESSION['addUserTkn']) && $_SESSION['addUserTkn'] == $tkn){
            $firstName      = trim($_POST['fname']);
            $lastName       = trim($_POST['lname']);
            $user_email     = trim($_POST['user_email']);
            $phone_number   = trim($_POST['phone_number']);
            $user_pwd       = trim($_POST['user_pwd']);
            $c_pwd          = trim($_POST['password_confirmation']);
            $user_role      = trim($_POST['rle']);
            
            $branch_name    = 1;
            $added_by       = $_SESSION['uid'];
            $merchant_ID     = $_SESSION['merchant_ID'];

            $key_details = $user_email."-".$phone_number."-".$user_pwd;

            $userKey = hash_hmac('sha512', $key_details, $user_email);



            //check if there is no empty
            if (empty($firstName)){
                $error = true;
                echo "<span>First Name Cannot be empty</span >";
            }

            elseif (empty($lastName)){
                $error = true;
                echo "<span>Lst Name Cannot be empty</span >";
            }

            elseif (empty($user_email)){
                $error = true;
                echo "<span>Email Cannot be empty</span >";
            }

            elseif (empty($user_pwd)){
                $error = true;
                echo "<span>Password Cannot be empty</span >";
            }

            elseif (empty($c_pwd)){
                $error = true;
                echo "<span>Confirm Password</span >";
            }

            elseif (empty($user_role)){
                $error = true;
                echo "<span>User Role Cannot be empty</span > ". $user_role;
            }

            elseif (!$error){
                //check if user already exist
                require_once 'GetUserByEmail.php';
                $getRst      = GetUserByEmail::callUserByEmail($user_email);
                $cntEmail   = $getRst->rowCount();
                if ($cntEmail < 1) {

                    $tbl = 'users';
                    $new_password = hash('sha256', $user_pwd);
                    $data = array(
                        'adb' => "$added_by",
                        'fn' => $firstName,
                        'ln' => $lastName,
                        'em' => $user_email,
                        'pd' => $new_password,
                        'rl' => $user_role,
                        'ubr'=> $branch_name,
                        'md'=>$merchant_ID,
                        'phn' => $phone_number,
                        'usk' => $userKey
                    );

                    if (UserModel::addUser($tbl, $data)) {
                        echo "<span>Entry Successful.</span>";
                    } else {
                        echo "<span'>Entry Unsuccessful</span>";
                    }
                }
                else{
                    echo "<span>User with same Email already exists</span>";
                }
            }
        }
        else{
            echo "<span>Action not Permitted</span >";
        }
    }
}

AddUserController::addUser();
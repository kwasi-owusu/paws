<?php

session_start();
class UpdateMyPasswordController
{
    static public function changeMyPassword(){
        $getToken   = trim($_POST['tkn']);
        $error      = false;
        if (isset($_SESSION['userPwdTkn']) && $_SESSION['userPwdTkn'] == $getToken){
            $user_ID    = trim($_POST['user_ID']);
            $user_pwd   = trim($_POST['user_pwd']);
            $confirmPwd = trim($_POST['password_confirmation']);

            if (empty($user_pwd)){
                $error  = true;
                echo "<span style='color: #b9090e'>User Password cannot be empty</span>";
            }
            elseif (empty($confirmPwd)){
                $error  = true;
                echo "<span style='color: #b9090e'>Confirm User Password cannot be empty</span>";
            }

            elseif (!$error){
                require_once('../../model/users/UserModel.php');
                $lastUpdateBy   = $_SESSION['uid'];;
                $lastUpdateOn   = Date('Y-m-d');
                $new_password = hash('sha256', $user_pwd);
                $tbl    = 'users_tbl';
                $data   = array(
                    'ud'=>$user_ID,
                    'npd'=>$new_password,
                    'lb'=>$lastUpdateBy,
                    'ln'=>$lastUpdateOn
                );
                if (UserModel::updateUserPwd($tbl, $data)){
                    echo "<span style='color: #1b901d'>Update Successful.</span> ". $new_password;
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

UpdateMyPasswordController::changeMyPassword();
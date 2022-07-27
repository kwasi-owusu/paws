<?php
session_start();
class UserLogin{
    static public function ctrUserLogin()
    {
        if (isset($_POST["lgnUser"])) {
            $error = false;
            $get_tkn = trim($_POST['lgn-tkn']);
            $val = $_POST["lgnUser"];
            if (isset($_SESSION['loginPage']) && $_SESSION['loginPage'] == $get_tkn) {

                if (empty($_POST["lgnUser"])) {
                    $error = true;
                    echo "<span style='color: #b9090e'>User Name is required</span>";
                } elseif (empty($_POST["lgnPwd"])) {
                    $error = true;
                    echo "<span style='color: #b9090e'>Password is required</span>";
                }

                if (!$error) {
                        //send to table
                        $myUserTbl  = 'users';
                        $itm        = 'userEmail';


                        require_once '../model/LoginUserModel.php';
                        //require_once '../../controller/activities/ActivitiesCTRL.php';
                        $rqsModel = LoginUserModel::MdlShowUsers($myUserTbl, $itm, $val);

                        //var_dump($rqsModel);
                        $new_password = hash('sha256', $_POST["lgnPwd"]);

                        if (isset($rqsModel["userEmail"]) && $rqsModel["userEmail"] == $_POST["lgnUser"] && $rqsModel["userPassword"] == $new_password
                            && $rqsModel["userStatus"] == 1) {

                            //user is admitted
                            $_SESSION['uid'] = $rqsModel['user_ID'];
                            $_SESSION['fnm'] = $rqsModel['firstName'];
                            $_SESSION['lnm'] = $rqsModel['lastName'];
                            $_SESSION['em'] = $rqsModel['userEmail'];
                            $_SESSION['user_type'] = $rqsModel['userRole'];
                            $_SESSION['merchant_ID'] = $rqsModel['merchant_ID'];
                            $_SESSION['branch_ID'] = $rqsModel['branch_ID'];
                            $_SESSION['branch_name'] = $rqsModel['branch_ID'];
                            $_SESSION['isLogin'] = "1";

                            $userIS         = $val;
                            $activityDesc   = "Login Successful";
                           // $ActivitiesCTRL::CTRLActivities($userIS, $activityDesc);

                           echo "Login Successful";

                           exit();

                   
                        }

                        else {

                            echo "<span>Username or password incorrect</span> ";

                            exit();

                            $userIS         = $val;
                            $activityDesc   = "Login Attempt";
                            //$saveActivity   = ActivitiesCTRL::CTRLActivities($userIS, $activityDesc);
                        }
                }
            }
            else{
                echo '<span style="color: #f02e05;">Action Not Permitted</span>';
                $userIS         = $val;
                $activityDesc   = "Login Attempt";
                //$saveActivity   = ActivitiesCTRL::CTRLActivities($userIS, $activityDesc);
            }
        }

        else{
            echo "<span style='color: #f02e05;'>Action Not Permitted </span>";
        }
    }

}
UserLogin::ctrUserLogin();
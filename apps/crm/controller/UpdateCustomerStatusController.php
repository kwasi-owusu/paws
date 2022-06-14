<?php

session_start();
class UpdateCustomerStatusController
{
    static public function changeCustomerStatus(){
        require_once('../model/UpdateCustomerModel.php');

        $tkn = trim($_POST['userStatusTkn']);
        $error = false;
        if (isset($_SESSION['customerStatus']) && $_SESSION['customerStatus'] == $tkn){
            $customer_ID    = trim($_POST['customer_ID']);
            $c_status       = trim($_POST['c_status']);

            if (empty($c_status)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer Status Cannot be empty</span >";
            }

            elseif (!$error){
                $tbl            = 'customers';
                $lastUpdateBy   = '1';
                $lastUpdateOn   = Date('Y-m-d');
                $data           = array(
                    'cd' => $customer_ID,
                    'ucs'=>$c_status,
                    'lb'=>$lastUpdateBy,
                    'ln'=>$lastUpdateOn
                );
                if (UpdateCustomerModel::updateCustomerStatus($tbl, $data)){
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

$callMethod     = new UpdateCustomerStatusController();
$thisMethod     = $callMethod->changeCustomerStatus();
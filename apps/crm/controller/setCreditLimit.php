<?php
session_start();

class setCreditLimit
{
    static public function creditLimit(){
        require_once('../../model/crm/CustomerModel.php');
        $tkn = trim($_POST['customer_credit_limit_tkn']);
        $error = false;
        if (isset($_SESSION['setCreditLimit']) && $_SESSION['setCreditLimit'] == $tkn){
            $customer_ID       = trim($_POST['customer_ID']);
            $credit_limit      = trim($_POST['credit_limit']);


            if (empty($credit_limit)){
                $error = true;
                echo "<span style='color: #b9090e'>Credit Limit Cannot be empty</span >";
            }

            elseif (empty($customer_ID)){
                $error = true;
                echo "<span style='color: #b9090e'>Customer ID Cannot be empty</span >";
            }

            elseif (!$error){
                $tbl            = 'customers';
                $lastUpdateBy   = '1';
                $lastUpdateOn   = Date('Y-m-d');
                $data           = array(
                    'cd' => $customer_ID,
                    'cl'=>$credit_limit,
                    'ln'=>$lastUpdateOn,
                    'lb'=>$lastUpdateBy
                );
                if (CustomerModel::setCreditLimit($tbl, $data)){
                    echo "<span style='color: #1b901d'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Entry Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #b9090e'>Action not Permitted</span >";
        }
    }
}

$callMethod     = new setCreditLimit();
$thisMethod     = $callMethod->creditLimit();
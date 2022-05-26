<?php

session_start();
class AddNewSalesPersonToShop
{
    static public function saveSalesPerson(){
        $error      = false;
        $getToken   = strip_tags(trim($_POST['tkn']));
        if (isset($_SESSION['addSalesPerson']) && $_SESSION['addSalesPerson'] == $getToken){
            $salesPerson    = strip_tags(trim($_POST['salesPerson']));
            $store_ID       = strip_tags(trim($_POST['store_ID']));
            $addedBY        = $_SESSION['uid'];

            require_once ('../../model/pos/MDLAddNewSalesPersonToShop.php');
            $tbl            = 'sales_persons';
            $data       = array(
                'sp'=> $salesPerson,
                'sd' => $store_ID,
                'adb' => $addedBY
            );

            //check if already exist
            $checkSalesPerson   = MDLAddNewSalesPersonToShop::checkIfSalesOfficerAdded($tbl, $data);
            $cntEntries         = $checkSalesPerson->rowCount();
            if ($cntEntries > 0){
                $error = true;
                echo "<span>Sales Person Already added to Shop</span>";
            }

            elseif(!$error){

                if (MDLAddNewSalesPersonToShop::saveSalesPerson($tbl, $data)){
                    echo "<span>Sales Person Added Successfully</span>";
                }

                else{
                    echo "<span>Sales Person Adding Unsuccessfully</span>";
                }
            }
        }
        else{
            echo "<span>Action Not Permitted.</span>";
        }
    }
}

$callClass   = new AddNewSalesPersonToShop();
$callMethod  = $callClass-> saveSalesPerson();
<?php

session_start();
class AddNewSalesPersonToShop
{
    public static function saveSalesPerson()
    {
        $error      = false;
        $getToken   = strip_tags(trim($_POST['tkn']));
        if (isset($_SESSION['editShopToken']) && $_SESSION['editShopToken'] == $getToken) {
            $salesPerson    = strip_tags(trim($_POST['salesPerson']));
            $store_ID       = strip_tags(trim($_POST['store_ID']));
            $addedBY        = $_SESSION['uid'];

            require_once('../model/MDLAddNewSalesPersonToShop.php');
            $tbl            = 'sales_persons';
            $data       = array(
                'sp' => $salesPerson,
                'sd' => $store_ID,
                'adb' => $addedBY
            );

            //check if already exist
            if (!$error) {
                $checkSalesPerson   = MDLAddNewSalesPersonToShop::checkIfSalesOfficerAdded($tbl, $data);
                $cntEntries         = $checkSalesPerson->rowCount();
                if ($cntEntries > 0) {
                    // update sales person shop
                    if (MDLAddNewSalesPersonToShop::updateSalesPerson($tbl, $data)) {
                        echo "<span>Sales Person Updated Successfully</span>";
                    } else {
                        echo "<span>Sales Person Update Unsuccessfully</span>";
                    }
                } else {

                    //save a new record
                    if (MDLAddNewSalesPersonToShop::saveSalesPerson($tbl, $data)) {
                        echo "<span>Sales Person Added Successfully</span>";
                    } else {
                        echo "<span>Sales Person Adding Unsuccessfully</span>";
                    }
                }
            } else {
                echo "<span>Action Not Permitted.</span>";
            }
        }
    }
}

AddNewSalesPersonToShop::saveSalesPerson();

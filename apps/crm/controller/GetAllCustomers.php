<?php

class GetAllCustomers
{
    static public function allCustomerListController()
    {

        $myRole = $_SESSION['user_type'];
        $merchant_ID = $_SESSION['merchant_ID'];
        $me     = $_SESSION['uid'];
        $tbl_a = 'customers';
        $tbl_b = 'countries';
        $tbl_c = 'states';

        require_once('../model/AllCustomerList.php');

        $allCustomers    = AllCustomerList::fetchAllCustomerList($tbl_a, $tbl_b, $tbl_c, $myRole, $merchant_ID, $me);

        return $allCustomers;
    }

    static public function activeCustomers()
    {
        require_once('../model/AllCustomerList.php');
        $tbl_a = 'customers';
        $tbl_b = 'customercategories';
        $allActiveCustomers     = AllCustomerList::getActiveCustomers($tbl_a, $tbl_b);

        return $allActiveCustomers;
    }
}

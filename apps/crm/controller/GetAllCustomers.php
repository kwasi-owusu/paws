<?php

class GetAllCustomers
{
static public function allCustomerListController(){
    $tbl_a = 'customers';
    $tbl_b = 'customercategories';
    require_once('../model/AllCustomerList.php');
    $allCustomers    = AllCustomerList::fetchAllCustomerList($tbl_a, $tbl_b);

    return $allCustomers;
}

static public function activeCustomers(){
    require_once('../model/AllCustomerList.php');
    $tbl_a = 'customers';
    $tbl_b = 'customercategories';
    $allActiveCustomers     = AllCustomerList::getActiveCustomers($tbl_a, $tbl_b);

    return $allActiveCustomers;
}
}
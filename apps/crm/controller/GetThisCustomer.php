<?php


class GetThisCustomer
{
    static public function thisCustomer($customer_ID)
    {
        $tbl_a = 'customers';
        $tbl_b = 'countries';
        $tbl_c = 'states';
        $cust_ID    = $customer_ID;

        require_once('../../model/CallThisCustomer.php');
        $thisCustomer    = CallThisCustomer::selectThisCustomer($tbl_a, $tbl_b, $tbl_c, $cust_ID);

        return $thisCustomer;
    }
}

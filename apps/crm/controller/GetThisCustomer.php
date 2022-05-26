<?php


class GetThisCustomer
{
    static public function thisCustomer($customer_ID){
        $tbl      = 'customers';
        $cust_ID    = $customer_ID;
        require_once('../../../../model/crm/CallThisCustomer.php');
        $thisCustomer    = CallThisCustomer::selectThisCustomer($tbl, $cust_ID);

        return $thisCustomer;
    }
}
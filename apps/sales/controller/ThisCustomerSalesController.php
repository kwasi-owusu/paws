<?php

require_once('../../../model/sales/ThisCustomerSalesModel.php');
class ThisCustomerSalesController
{
    static public function thisCustomerOrders($customer_key){
        $getSales   = ThisCustomerSalesModel::thisCustomerSales($customer_key);

        return $getSales;
    }
}
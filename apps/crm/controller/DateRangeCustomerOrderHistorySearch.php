<?php


class DateRangeCustomerOrderHistorySearch
{
    static public function thisCustomerOrders($customer_key, $start_date, $end_date){
        require_once('../../../model/crm/ThisCustomerSalesDateRangeSearchModel.php');
        $getSales   = ThisCustomerSalesDateRangeSearchModel::thisCustomerSalesDateRange($customer_key, $start_date, $end_date);

        return $getSales;
    }
}
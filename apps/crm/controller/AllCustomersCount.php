<?php


class AllCustomersCount
{
    static public function loadAllCustomersCount(){
        require_once('../../model/crm/GetActiveCustomers.php');
        $tbl        = 'customers';
        $getRst     = GetActiveCustomers::loadActiveCustomers($tbl);

        return $getRst;
    }
}
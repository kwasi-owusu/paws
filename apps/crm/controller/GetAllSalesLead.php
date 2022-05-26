<?php

//session_start();
class GetAllSalesLead
{
    static public function callAllSalesLeads()
    {
        require_once('../model/AllSaleLeads.php');
        $me             = $_SESSION['uid'];
        $merchant_ID    = $_SESSION['merchant_ID'];
        $userType       = $_SESSION['user_type'];
        $tbl            = 'sales_lead';

        $data = array(
            'm' => $me,
            'md' => $merchant_ID,
            'ust'=> $userType,
        );

        $getRst         = AllSaleLeads::SalesLeads($tbl, $data);

        return $getRst;
    }
}

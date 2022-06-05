<?php

//session_start();
require_once('../model/AllSaleLeads.php');
class GetAllSalesLead extends AllSaleLeads
{
    public static function callAllSalesLeads()
    {
        
        $tbl            = 'sales_lead';

        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type']
        );

        $getRst         = AllSaleLeads::SalesLeads($tbl, $data);

        return $getRst;
    }
}

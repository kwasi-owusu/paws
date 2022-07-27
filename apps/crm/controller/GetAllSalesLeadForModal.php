<?php
class GetAllSalesLeadForModal{
    public static function callAllSalesLeadsForModal($lead_ID)
    {

        require_once('../../model/AllSaleLeadsForModal.php');
        
        $tbl            = 'sales_lead';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'], 
            'ld' => $lead_ID
        );

        $getRst         = AllSaleLeadsForModal::salesLeadsForModal($tbl, $data);

        return $getRst;
    }
}
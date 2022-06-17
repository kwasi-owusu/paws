<?php

class GetThisSalesLead{
    static public function thisSalesLead($lead_ID){
        $tbl      = 'sales_lead';
        
        require_once('../../model/GetThisLead.php');
        $thisLead    = GetThisLead::selectThisLead($tbl, $lead_ID);

        return $thisLead;
    }
}
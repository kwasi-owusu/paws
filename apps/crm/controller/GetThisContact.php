<?php


class GetThisContact
{
    static public function thisContact($contact_ID){
        $tbl      = 'contact_tbl';
        $cnt_ID    = $contact_ID;
        require_once('../../../../model/crm/CallThisContact.php');
        $thisCustomer    = CallThisContact::selectThisContact($tbl, $cnt_ID);

        return $thisCustomer;
    }
}
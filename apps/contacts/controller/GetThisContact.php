<?php


class GetThisContact
{
    static public function thisContact($contact_ID){
        $tbl      = 'contacts';
        $cnt_ID    = $contact_ID;
        require_once('../../model/CallThisContact.php');
        $thisCustomer    = CallThisContact::selectThisContact($tbl, $cnt_ID);

        return $thisCustomer;
    }
}
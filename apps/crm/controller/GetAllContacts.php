<?php

//session_start();
class GetAllContacts
{
    static public function callAllContacts(){
        require_once('../../../model/crm/AllContactList.php');
        $me         = $_SESSION['uid'];
        $data_owner = $_SESSION['data_owner'];
        $tbl        = 'contact_tbl';
        $getRst     = AllContactList::AllCustomerCat($tbl, $me, $data_owner);

        return $getRst;
    }
}
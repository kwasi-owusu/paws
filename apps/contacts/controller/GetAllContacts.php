<?php

//session_start();
class GetAllContacts
{
    static public function callAllContacts(){

        require_once('../model/AllContactList.php');
        $me             = $_SESSION['uid'];
        $merchant_ID    = $_SESSION['merchant_ID'];
        $userType       = $_SESSION['user_type'];
        $tbl            = 'contacts';

        $data = array(
            'me' => $me,
            'md' => $merchant_ID,
            'ust' => $userType
        );
        $getRst         = AllContactList::getContactLists($tbl, $data);

        return $getRst;
    }
}
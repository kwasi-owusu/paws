<?php

//session_start();
require_once('../model/AllContactList.php');
class GetAllContacts
{
    static public function callAllContacts(){

        //require_once('../model/AllContactList.php');
        $me             = $_SESSION['uid'];
        $merchant_ID    = $_SESSION['merchant_ID'];
        $userType       = $_SESSION['user_type'];
        $tbl            = 'contacts';
        $tbl_b          = 'contact_category';

        $data = array(
            'me' => $me,
            'md' => $merchant_ID,
            'ust' => $userType
        );
        $getRst         = AllContactList::getContactLists($tbl, $tbl_b , $data);

        return $getRst;
    }

    public static function contactCats(){

        $getRst = AllContactList::contactCategories();

        return $getRst;
    }
}
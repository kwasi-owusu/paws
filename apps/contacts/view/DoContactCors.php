<?php
class DoContactCors{
    public static function addContactCors($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $addContactTkn = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $addContactTkn;
    }

    public static function editContact($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $editContactTkn = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $editContactTkn;
    }

    public static function deleteContact($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $deleteContactTkn = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $deleteContactTkn;
    }
}

?>
<?php

class DoEmailCors {
    public static function checkSPam($page_name){

        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $spamTkn = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $spamTkn;

    }


}
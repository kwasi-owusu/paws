<?php


class DoPOSCors
{
    static public function posCors($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $posCors = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $posCors;
    }
    
    static public function posSettings($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $posCors = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $posCors;
    }
    


    static public function editUShopCors($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $setupStores = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $setupStores;
    }

    static public function addSalesPersonToShop(){
        $page_is        = "do.addSalesPersonToShop.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $addSalesPerson = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $addSalesPerson;
    }

    static public function transferToShopCors(){
        $page_is        = "do.addSalesPersonToShop.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $addSalesPerson = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $addSalesPerson;
    }

}
<?php
class DoCustomerCors{

    public static function addCustomer($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $addCustomerTkn = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $addCustomerTkn;
    }
    
    public static function addNewSalesLead($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $addNewSalesLead = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $addNewSalesLead;
    }
    
    public static function salesPipeline($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $salesPipeline = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $salesPipeline;
    }

    
    public static function editCustomerCors($page_name){
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is.$thi_is_is;

        $editCustomerCorsTkn = hash_hmac('sha512', $rock_hash, $thi_is_is);


        return $editCustomerCorsTkn;
    }


}

?>
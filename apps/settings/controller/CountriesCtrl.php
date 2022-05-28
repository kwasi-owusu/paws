<?php
class CountriesCtrl{
    public static function getAllCountries(){
        
        require_once '../model/Countries.php';
                
        $getRst     = Countries::allCountries();

        return $getRst;
    }   
}

?>
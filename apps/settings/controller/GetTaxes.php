<?php

require_once('../../../model/settings/GetTaxesMdl.php');
class GetTaxes
{
    static public function loadPOTaxes(){
        $poTaxRst    = GetTaxesMdl::poTaxes();

        return $poTaxRst;

    }

    static public function loadSOTaxes(){
        $soTaxes    = GetTaxesMdl::soTaxes();

        return $soTaxes;
    }

    //call Taxes

    static public function callVAT(){
        $vt     = GetTaxesMdl::getVAT();

        return $vt;
    }


    static public function callNHIL(){
        $nh     = GetTaxesMdl::getNHIL();

        return $nh;
    }

    static public function callGetFund(){
        $gtf     = GetTaxesMdl::getFund();

        return $gtf;
    }

    static public function callCovidTax(){
        $cvd     = GetTaxesMdl::covidTax();

        return $cvd;
    }

    static public function callSpecialVAT(){
        $cvd     = GetTaxesMdl::getRetailVAT();

        return $cvd;
    }
}
<?php

require_once('../../model/settings/GetTaxesForMailMdl.php');
class GetTaxesForEmail
{
    static public function loadPOTaxes(){
        $poTaxRst    = GetTaxesForMailMdl::poTaxes();

        return $poTaxRst;

    }

    static public function loadSOTaxes(){
        $soTaxes    = GetTaxesForMailMdl::soTaxes();

        return $soTaxes;
    }

    //call Taxes

    static public function callVAT(){
        $vt     = GetTaxesForMailMdl::getVAT();

        return $vt;
    }


    static public function callNHIL(){
        $nh     = GetTaxesForMailMdl::getNHIL();

        return $nh;
    }

    static public function callGetFund(){
        $gtf     = GetTaxesForMailMdl::getFund();

        return $gtf;
    }

    static public function callCovidTax(){
        $cvd     = GetTaxesForMailMdl::covidTax();

        return $cvd;
    }

    static public function callSpecialVAT(){
        $cvd     = GetTaxesForMailMdl::getRetailVAT();

        return $cvd;
    }
}
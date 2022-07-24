<?php

require_once '../../../model/connection.php';
class GetTaxesMdl
{
    static public function poTaxes(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_application = 1");
        $stmt->execute();

        return $stmt;
    }

    static public function soTaxes(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_application = 2");
        $stmt->execute();

        return $stmt;
    }

    //get VAT
    static public function getVAT(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 1");
        $stmt->execute();

        return $stmt;
    }

    //get Retail VAT
    static public function getRetailVAT(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 5");
        $stmt->execute();

        return $stmt;
    }

    //get NHIL
    static public function getNHIL(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 2");
        $stmt->execute();

        return $stmt;
    }

    //get Getfund
    static public function getFund(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 3");
        $stmt->execute();
        return $stmt;
    }

    static public function covidTax(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 4");
        $stmt->execute();
        return $stmt;
    }
}
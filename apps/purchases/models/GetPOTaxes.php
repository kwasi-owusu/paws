<?php

require_once '../../model/connection.php';
class GetPOTaxes
{
    static public function thisPOTaxes(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_application = 1");
        $stmt->execute();

        return $stmt;
    }

    static public function thisSOTaxes(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_application = 2");
        $stmt->execute();

        return $stmt;
    }

    //get VAT
    static public function doGetVAT(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 1");
        $stmt->execute();

        return $stmt;
    }

    //get NHIL
    static public function doGetNHIL(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 2");
        $stmt->execute();

        return $stmt;
    }

    //get Getfund
    static public function doGetFund(){
        $stmt   = Connection::connect()->prepare("SELECT * FROM setup_tax WHERE tax_ID = 3");
        $stmt->execute();
        return $stmt;
    }
}
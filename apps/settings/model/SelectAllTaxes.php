<?php

require_once '../../template/statics/conn/connection.php';
class SelectAllTaxes
{
    public static function getVatTax($txTbl){
        $taxName = 'VAT';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function getNHILTax($txTbl){
        $taxName    = 'NHIL';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function getFundTax($txTbl){
        $taxName    = 'GetFund';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function covidTax($txTbl){
        $taxName    = 'CovidTax';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function specialVAT($txTbl){
        $taxName    = 'RetailVAT';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
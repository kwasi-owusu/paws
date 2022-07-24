<?php

require_once '../../model/connection.php';
class SelectAllTaxes
{
    static public function getVatTax($txTbl){
        $taxName = 'VAT';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function getNHILTax($txTbl){
        $taxName    = 'NHIL';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function getFundTax($txTbl){
        $taxName    = 'GetFund';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function covidTax($txTbl){
        $taxName    = 'CovidTax';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function specialVAT($txTbl){
        $taxName    = 'RetailVAT';
        $stmt   = Connection::connect()->prepare("SELECT * FROM $txTbl WHERE tax_name = :txn");
        $stmt->bindParam('txn', $taxName, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
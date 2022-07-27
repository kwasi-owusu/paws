<?php

require_once '../../../template/statics/conn/connection.php';
class AllSaleLeadsForModal
{
    public static function salesLeadsForModal($tbl, $data)
    {

        $stmt = Connection::connect()->prepare("SELECT * FROM $tbl 
            WHERE merchant_ID = :merchant_ID 
            AND lead_ID = :ld
            ");
        $stmt->bindParam('merchant_ID', $data['md'], PDO::PARAM_STR);
        $stmt->bindParam('ld', $data['ld'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

<?php
require_once '../../../template/statics/conn/connection.php';

class ThisShopDetails
{
    public static function loadThisShops($tbl, $data)
    {

        if ($data['ust'] == 2) {
            $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE store_ID = :sn AND merchant_ID = :mcd LIMIT 1");
            $stmt->bindParam('sn', $data['sd'], PDO::PARAM_STR);
            $stmt->bindParam('mcd', $data['md'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }
        elseif($data['ust'] == 1){
            $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE store_ID = :sn LIMIT 1");
            $stmt->bindParam('sn', $data['sd'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }
    }
}

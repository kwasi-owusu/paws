<?php
require_once '../../template/statics/conn/connection.php';

class CheckEmailsMdl{
    public static function checkCustomerEmail($val){
        $stmt   = Connection::connect()->prepare("SELECT * FROM customers WHERE customa_email = :cem LIMIT 1");
        $stmt->bindParam(':cem',$val, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function checkSupplierEmail($val){
        $stmt   = Connection::connect()->prepare("SELECT * FROM suppliers WHERE supp_email = :cem LIMIT 1");
        $stmt->bindParam(':cem',$val, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function checkUserEmail($val){
        $stmt   = Connection::connect()->prepare("SELECT * FROM users WHERE userEmail = :cem LIMIT 1");
        $stmt->bindParam(':cem',$val, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
    
    public static function checkContactEmail($val){
        $stmt   = Connection::connect()->prepare("SELECT * FROM contacts WHERE contact_email = :cem LIMIT 1");
        $stmt->bindParam(':cem',$val, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public static function checkMerchantEmail($val){
        $stmt   = Connection::connect()->prepare("SELECT * FROM merchants WHERE email = :cem LIMIT 1");
        $stmt->bindParam(':cem',$val, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}

?>
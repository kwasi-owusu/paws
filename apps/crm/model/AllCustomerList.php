<?php

require_once '../../template/statics/conn/connection.php';
class AllCustomerList
{
    public static function fetchAllCustomerList($tbl_a, $tbl_b, $tbl_c)
    {
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.* 
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.country = $tbl_b.id 
        INNER JOIN $tbl_c ON $tbl_a.state = $tbl_c.id
        ORDER BY $tbl_a.customa_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getActiveCustomers($tbl_a, $tbl_b){
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
        FROM $tbl_a, $tbl_b 
        WHERE $tbl_a.cust_cat = $tbl_b.customer_cat_ID
        AND $tbl_a.customerStatus = 1
        ORDER BY $tbl_a.customa_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
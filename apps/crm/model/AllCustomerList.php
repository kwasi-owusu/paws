<?php

require_once '../../template/statics/conn/connection.php';
class AllCustomerList
{
    static public function fetchAllCustomerList($tbl_a, $tbl_b)
    {
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
        FROM $tbl_a, $tbl_b 
        WHERE $tbl_a.cust_cat = $tbl_b.customer_cat_ID
        ORDER BY $tbl_a.customa_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function getActiveCustomers($tbl_a, $tbl_b){
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
        FROM $tbl_a, $tbl_b 
        WHERE $tbl_a.cust_cat = $tbl_b.customer_cat_ID
        AND $tbl_a.customerStatus = 1
        ORDER BY $tbl_a.customa_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
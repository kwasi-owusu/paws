<?php

require_once '../../template/statics/conn/connection.php';
class GetMyTodaySalesMdl
{
    static public function mySalesForToday($me, $tbl){
        $tdy = Date('d');
        $mnt = Date('m');
        $yr = Date('Y');

        $stmt  = Connection::connect()->prepare("SELECT * FROM $tbl 
        WHERE addedBy = :m
        AND sales_day = :sd 
        AND sales_month = :sm 
        AND sales_yr = :sy 
        ORDER BY addedOn ASC
        ");

        $stmt->bindParam('m', $me, PDO::PARAM_STR);
        $stmt->bindParam('sd', $tdy, PDO::PARAM_STR);
        $stmt->bindParam('sm', $mnt, PDO::PARAM_STR);
        $stmt->bindParam('sy', $yr, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function SalesForTodayDetails($me, $tbl, $tbl_b, $tbl_c){
        $tdy = Date('d');
        $mnt = Date('m');
        $yr = Date('Y');

        $stmt  = Connection::connect()->prepare("SELECT $tbl.*, $tbl_b.*, $tbl_c.* 
        FROM $tbl 
        INNER JOIN $tbl_b ON $tbl.transaction_ID = $tbl_b.itm_transaction_ID
        INNER JOIN $tbl_c ON $tbl.transaction_ID = $tbl_c.fin_transaction_ID 
        WHERE $tbl.addedBy = :m
        AND $tbl.sales_day = :sd 
        AND $tbl.sales_month = :sm 
        AND $tbl.sales_yr = :sy 
        ORDER BY $tbl_b.trans_item_ID DESC
        ");

        $stmt->bindParam('m', $me, PDO::PARAM_STR);
        $stmt->bindParam('sd', $tdy, PDO::PARAM_STR);
        $stmt->bindParam('sm', $mnt, PDO::PARAM_STR);
        $stmt->bindParam('sy', $yr, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
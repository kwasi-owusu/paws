<?php

require_once '../../../model/connection.php';
class GetPOSReport
{
    static public function allTimeReport(){
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        ORDER BY pos_trans.transaction_ID DESC
        ");

        $stmt->execute();

        return $stmt;
    }

    static public function thisMonthPOSSales(){
        $sm     = Date('m');
        $sy     = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        WHERE pos_trans.sales_month = :sm
        AND pos_trans.sales_yr = :sy 
        ORDER BY pos_trans.transaction_ID DESC
        ");

        $stmt->bindParam('sm', $sm, PDO::PARAM_STR);
        $stmt->bindParam('sy', $sy, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function thisYearPOSSales(){
        $sm     = Date('m');
        $sy     = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        WHERE pos_trans.sales_yr = :sy
        ORDER BY pos_trans.transaction_ID DESC
        ");

        $stmt->bindParam('sy', $sy, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    //individual Sales Person report
    static public function allTimeSalesPerson($salesPerson){
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        WHERE pos_trans.addedBy = :ad
        ORDER BY pos_trans.transaction_ID DESC
        ");
        $stmt->bindParam('ad', $salesPerson, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function thisMonthSalesPerson($salesPerson){
        $sm     = Date('m');
        $sy     = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        WHERE pos_trans.sales_month = :sm
        AND pos_trans.sales_yr = :sy
        AND pos_trans.addedBy = :ad
        ORDER BY pos_trans.transaction_ID DESC
        ");

        $stmt->bindParam('sm', $sm, PDO::PARAM_STR);
        $stmt->bindParam('sy', $sy, PDO::PARAM_STR);
        $stmt->bindParam('ad', $salesPerson, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function thisYearSalesPerson($salesPerson){
        $sy     = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        WHERE pos_trans.sales_yr = :sy
        AND pos_trans.addedBy = :ad
        ORDER BY pos_trans.transaction_ID DESC
        ");

        $stmt->bindParam('sy', $sy, PDO::PARAM_STR);
        $stmt->bindParam('ad', $salesPerson, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function thisSpecificSalesDetails($saleID){
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.*, pos_trans_items.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        INNER JOIN pos_trans_items ON pos_trans.transaction_ID = pos_trans_items.itm_transaction_ID
        WHERE pos_trans.transaction_ID = :sd
        ORDER BY pos_trans.transaction_ID DESC
        ");
        $stmt->bindParam('sd', $saleID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    static public function thisMonthPSumTotal(){
        $sm     = Date('m');
        $sy     = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.trans_fin_ID, 
        pos_trans_financials.fin_transaction_ID, pos_trans_financials.curr, pos_trans_financials.final_total, 
        SUM(pos_trans_financials.final_total) AS sumTotal
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        WHERE pos_trans.sales_month = :sm
        AND pos_trans.sales_yr = :sy 
        ORDER BY pos_trans.transaction_ID DESC
        ");

        $stmt->bindParam('sm', $sm, PDO::PARAM_STR);
        $stmt->bindParam('sy', $sy, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function thisYearSumTotal(){
        $sy     = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.trans_fin_ID, 
        pos_trans_financials.fin_transaction_ID, pos_trans_financials.curr, pos_trans_financials.final_total, 
        SUM(pos_trans_financials.final_total) AS sumTotal
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        WHERE pos_trans.sales_yr = :sy 
        ORDER BY pos_trans.transaction_ID DESC
        ");

        $stmt->bindParam('sy', $sy, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function AllTimeSumTotal(){
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.trans_fin_ID, 
        pos_trans_financials.fin_transaction_ID, pos_trans_financials.curr, pos_trans_financials.final_total, 
        SUM(pos_trans_financials.final_total) AS sumTotal
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        ORDER BY pos_trans.transaction_ID DESC
        ");
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
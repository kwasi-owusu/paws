<?php


class GetPOSRangeReport
{
    static public function rangeSumTotal($start_date, $end_date){
        require_once '../../../model/connection.php';
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.trans_fin_ID, 
        pos_trans_financials.fin_transaction_ID, pos_trans_financials.curr, pos_trans_financials.final_total, 
        SUM(pos_trans_financials.final_total) AS sumTotal
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        WHERE pos_trans.addedOn BETWEEN :std AND :edt
        ORDER BY pos_trans.transaction_ID DESC
        ");
        $stmt->bindParam('std', $start_date, PDO::PARAM_STR);
        $stmt->bindParam('edt', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function dateRangeReport($start_date, $end_date){
        require_once '../../../model/connection.php';
        $stmt = Connection::connect()->prepare("SELECT pos_trans.*, pos_trans_financials.*, users_tbl.* 
        FROM pos_trans
        INNER JOIN pos_trans_financials ON pos_trans.transaction_ID = pos_trans_financials.fin_transaction_ID
        INNER JOIN users_tbl ON pos_trans.addedBy = users_tbl.user_ID
        WHERE pos_trans.addedOn BETWEEN :std AND :edt
        ORDER BY pos_trans.transaction_ID DESC
        ");
        $stmt->bindParam('std', $start_date, PDO::PARAM_STR);
        $stmt->bindParam('edt', $end_date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
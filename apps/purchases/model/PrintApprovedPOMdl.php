<?php

require_once '../../../model/connection.php';
class PrintApprovedPOMdl
{
    static public function printThisPO(){
        $stmt   = Connection::connect()->prepare("SELECT new_purch_oder.*, suppliers.* 
        FROM new_purch_oder
        INNER JOIN suppliers ON new_purch_oder.supp_ID = suppliers.supp_ID
        WHERE new_purch_oder.approval_status = 1
        ");
        $stmt->execute();

        return $stmt;
    }


    static public function printThisBranchPOWithDateRange($branch, $start_date, $end_date){
        $stmt   = Connection::connect()->prepare("SELECT new_purch_oder.*, suppliers.* 
        FROM new_purch_oder
        INNER JOIN suppliers ON new_purch_oder.supp_ID = suppliers.supp_ID
        WHERE new_purch_oder.approval_status = 1
        AND new_purch_oder.branch_owner = :mb
        AND new_purch_oder.AddedOn BETWEEN :sd AND :ed
        ");
        $stmt->bindParam('mb', $branch, PDO::PARAM_STR);
        $stmt->bindParam('sd', $start_date, PDO::PARAM_STR);
        $stmt->bindParam('ed', $end_date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}
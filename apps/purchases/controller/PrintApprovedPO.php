<?php


class PrintApprovedPO
{
    static public function printThisPO(){
        require_once '../../../model/purchases/PrintApprovedPOMdl.php';
        $getRst     = PrintApprovedPOMdl::printThisPO();

        return $getRst;
    }

    static public function printThisPOWithDateRange($branch, $start_date, $end_date){
        require_once '../../../model/purchases/PrintApprovedPOMdl.php';
        $getRst     = PrintApprovedPOMdl::printThisBranchPOWithDateRange($branch, $start_date, $end_date);

        return $getRst;
    }
}
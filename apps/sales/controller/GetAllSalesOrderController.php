<?php


class GetAllSalesOrderController
{
    static public function doAllSalesOrder(){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';

        $my_branch      = $_SESSION['branch_name'];
        $data_owner     = $_SESSION['data_owner'];
        $my_role        = $_SESSION['user_type'];
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllSalesOrder($tbl_a, $tbl_b, $tbl_c, $my_branch, $data_owner, $my_role);

        return $allRst;
    }

    static public function doAllPendingSalesOrder(){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllPendingSalesOrder($tbl_a, $tbl_b, $tbl_c);

        return $allRst;
    }

    static public function doAllApprovedSalesOrder(){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllApprovedSalesOrder($tbl_a, $tbl_b, $tbl_c);

        return $allRst;
    }

    static public function doAllPendingSalesOrderToProduction(){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_items';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllPendingSalesToProduction($tbl_a, $tbl_b, $tbl_c, $tbl_d);

        return $allRst;
    }

    static public function doAllPendingSalesQuote(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllPendingSalesQuote($tbl_a, $tbl_b, $tbl_c, $tbl_d);

        return $allRst;
    }

    static public function doAllPendingSalesQuotAmount(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $totalAmt    = AllSalesOrderModel::getAllPendingSalesQuoteAmt ($tbl_a, $tbl_d);

        return $totalAmt;
    }



    static public function doAllFollowUpSalesQuote(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllFollowUpSalesQuote($tbl_a, $tbl_b, $tbl_c, $tbl_d);

        return $allRst;
    }

    static public function doAllFollowUpSalesQuotAmount(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $totalAmt    = AllSalesOrderModel::getAllFollowUpSalesQuoteAmt ($tbl_a, $tbl_d);

        return $totalAmt;
    }





    static public function doAllNegotiationSalesQuote(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllNegotiationsSalesQuote($tbl_a, $tbl_b, $tbl_c, $tbl_d);

        return $allRst;
    }

    static public function doAllNegotiationSalesQuotAmount(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $totalAmt    = AllSalesOrderModel::getAllNegotiationsSalesQuoteAmt ($tbl_a, $tbl_d);

        return $totalAmt;
    }




    static public function doAllWonSalesQuote(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllWonSalesQuote($tbl_a, $tbl_b, $tbl_c, $tbl_d);

        return $allRst;
    }
    static public function doAllWonSalesQuotAmount(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $totalAmt    = AllSalesOrderModel::getAllWonSalesQuoteAmt ($tbl_a, $tbl_d);

        return $totalAmt;
    }




    static public function doAllLostSalesQuote(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $allRst    = AllSalesOrderModel::getAllLostSalesQuote($tbl_a, $tbl_b, $tbl_c, $tbl_d);

        return $allRst;
    }

    static public function doAllLostSalesQuotAmount(){
        $tbl_a  = 'sales_pipeline';
        $tbl_b  = 'customers';
        $tbl_c  = 'users_tbl';
        $tbl_d  = 'sales_pipeline_financials';
        require_once('../../../model/sales/AllSalesOrderModel.php');
        $totalAmt    = AllSalesOrderModel::getAllLostSalesQuoteAmt ($tbl_a, $tbl_d);

        return $totalAmt;
    }


}
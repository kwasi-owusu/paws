<?php

session_start();
class ActionSalesOrder
{
    static public function doActionSalesOrder(){
        $getToken       = trim($_POST['tkn']);
        $error          = false;
        if (isset($_SESSION['soActionToken']) && $_SESSION['soActionToken'] == $getToken){
            $sales_order_ID         = strip_tags(trim($_POST['sales_order_ID']));
            $so_action              = trim($_POST['so_action']);
            $action_comment         = strip_tags(trim($_POST['action_comment']));
            $addedBy                = $_SESSION['uid'];
            //$approve_to_production  = trim($_POST['approve_to_production']);

            if (!isset($so_action)){
                $error  = true;
                echo    "<span style='color: #ffffff;'>Unknown Error</span>";
            }
            elseif (!$error){
                require_once '../../model/sales/ActionSalesOrderMdl.php';
                $tbl    = 'sales_tbl';
                $tbl_b  = 'salesorderfinancial';
                $tbl_c  = 'invoices';
                $tbl_d  = 'payment_receivables';

                //get sales order financial details
                $salesFinancial = ActionSalesOrderMdl::getThisSalesOrderFinancialDetails($tbl, $tbl_b, $sales_order_ID);
                $getFin         = $salesFinancial->fetch(PDO::FETCH_ASSOC);

                $amountPaid     = $getFin['amountPaid'];
                $totalAmount    = $getFin['grandTotal'];
                $order_No       = $getFin['order_No'];
                $financeAddedOn = $getFin['addedOn'];
                $customer_ID    = $getFin['customer_ID'];
                $balance        = $getFin['grandTotal'] - $getFin['amountPaid'];
                $pmtTerms       = $getFin['instruction_note'];

                $data   = array(
                    'sd'=> $sales_order_ID,
                    'sa'=> $so_action,
                    'ac'=> $action_comment,
                    'amtPaid' => $amountPaid,
                    'adb'=> $addedBy,
                    'orderNum' => $order_No,
                    'financeAdded' => $financeAddedOn,
                    'customer' => $customer_ID,
                    'bal' => $balance,
                    'terms' => $pmtTerms,
                    'totalAmount' => $totalAmount
                );


                if (ActionSalesOrderMdl::doActionSO($tbl, $tbl_b, $tbl_c, $tbl_d, $data)){
                    echo "<span style='color: #ffffff;'>Action Successful</span>";
                }
                else{
                    echo "<span style='color: #ffffff;'>Action Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted</span>";
        }
    }
}

$callClass  = new ActionSalesOrder();
$callMethod = $callClass->doActionSalesOrder();
<?php

session_start();
class RequestInventoryTransferCtr
{
    static public function requestItemTrans(){
        $error      = false;
        $getToken   = trim($_POST['tkn']);
        if (isset($_SESSION['transferToken']) && $_SESSION['transferToken'] == $getToken){
            $product_name       = trim($_POST['product_name']);
            $storage_ID         = trim($_POST['storage_ID']);
            $product_code       = trim($_POST['product_code']);
            $received_qty       = trim($_POST['received_qty']);
            $transfer_qty          = strip_tags(trim($_POST['transfer_qty']));
            $po_ID              = trim($_POST['po_ID']);
            $unit_cost          = trim($_POST['unit_cost']);
            $wh_stored          = trim($_POST['wh_stored']);
            //$storage_address    = trim($_POST['storage_address']);
            $batch_num          = trim($_POST['batch_num']);
            $trans_reason       = strip_tags(trim($_POST['trans_reason']));
            $dy                 = Date('d');
            $mn                 = Date('m');
            $yr                 = Date('Y');
            $addedBy            = $_SESSION['uid'];
            $destination_wh     = trim($_POST['destination_wh']);

            $branch             = $destination_wh;

            $tbl                = 'transfer_inv_tbl';

            if (empty($transfer_qty)){
                $error  = true;
                echo "Quantity to Transfer cannot be empty";
            }

            elseif ($transfer_qty <= 0){
                $error = true;
                echo "Transfer Quantity must be above Zero(0)";
            }
            elseif (empty($trans_reason)){
                $error  = true;
                echo "Please provide a reason for Transfer";
            }

            if (!$error){
                $data   = array(
                    'pn'=> $product_name,
                    'sd'=> $storage_ID,
                    'pc'=> $product_code,
                    'rq'=> $received_qty,
                    'trq'=> $transfer_qty,
                    'pd'=> $po_ID,
                    'uc'=> $unit_cost,
                    'wh'=> $wh_stored,
                    'bn'=> $batch_num,
                    'tr'=> $trans_reason,
                    'd'=> $dy,
                    'm'=> $mn,
                    'y'=> $yr,
                    'adb'=> $addedBy,
                    'dst'=>$destination_wh,
                    'brn' => $branch
                );
                require_once '../../model/inventory/RequestInventoryMgtMdl.php';
                if (RequestInventoryMgtMdl::transferInvRequest($tbl, $data)){
                    echo "<span style='color: #ffffff;'>Transfer Successful</span>";
                }
                else{
                    echo "<span style='color: #ffffff;'>Transfer Unsuccessful</span>";
                }
            }


        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted </span>";
        }
    }
}

$callClass  = new RequestInventoryTransferCtr();
$callMethod = $callClass->requestItemTrans();
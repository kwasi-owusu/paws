<?php

session_start();
class MoveInventoryToShop
{
    public static function moveToShop(){
        $error = false;
        $getToken = trim($_POST['tkn']);
        if (isset($_SESSION['transferToken']) && $_SESSION['transferToken'] == $getToken){
            require_once '../../model/pos/MDLMoveThisItems.php';

            $product_name       = trim($_POST['product_name']);
            $storage_ID         = trim($_POST['storage_ID']);
            $product_code       = trim($_POST['product_code']);
            $received_qty       = trim($_POST['received_qty']);
            $transfer_qty       = strip_tags(trim($_POST['transfer_qty']));
            $po_ID              = trim($_POST['po_ID']);
            $unit_cost          = trim($_POST['unit_cost']);
            $wh_stored          = trim($_POST['wh_stored']);
            $storage_address    = trim($_POST['storage_address']);
            $batch_num          = trim($_POST['batch_num']);
            $trans_reason       = strip_tags(trim($_POST['trans_reason']));
            $dy                 = Date('d');
            $mn                 = Date('m');
            $yr                 = Date('Y');
            $addedBy            = $_SESSION['uid'];
            $destination_wh     = trim($_POST['destination_wh']);
            $branch             = $_POST['branch_owner'];
            $inventory_cat      = strip_tags(trim($_POST['inventory_cat']));
            $inventory_sub_cat  = strip_tags(trim($_POST['inventory_sub_cat']));
            $barcode            = strip_tags(trim($_POST['barcode']));
            $expiry_dt          = trim($_POST['expiry_dt']);
            $manu_dt            = trim($_POST['manu_dt']);


            $tbl                = 'sales_stock';
            $checkIfExist       = MDLMoveThisItems::checkIfItemExist($tbl, $product_code, $destination_wh);
            //$cntItems         = $checkIfExist->rowCount();

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
                echo "Provide a reason for Transfer";
            }

            if (!$error){
                $data   = array(
                    'pn'=> $product_name,
                    'sd'=> $storage_ID,
                    'pc'=> $product_code,
                    'rq'=> $received_qty,
                    'trq'=> $transfer_qty,
                    'ict' => $inventory_cat,
                    'isc'=> $inventory_sub_cat,
                    'pd'=> $po_ID,
                    'uc'=> $unit_cost,
                    'wh'=> $wh_stored,
                    'sad'=> $storage_address,
                    'bn'=> $batch_num,
                    'tr'=> $trans_reason,
                    'd'=> $dy,
                    'm'=> $mn,
                    'y'=> $yr,
                    'adb'=> $addedBy,
                    'dst'=>$destination_wh,
                    'brn' => $branch,
                    'brc'=>$barcode,
                    'exp' => $expiry_dt,
                    'mnd'=> $manu_dt
                );

                if ($checkIfExist < 1) {
                    if (MDLMoveThisItems::moveThisToStore($tbl, $data)) {
                        echo "<span style='color: #ffffff;'>Item Transfer Successful $checkIfExist</span>";
                    } else {
                        echo "<span style='color: #ffffff;'>Transfer Unsuccessful $checkIfExist</span>";
                    }
                }

                elseif ($checkIfExist > 0){
                    if (MDLMoveThisItems::updateShopItems($tbl, $data)) {
                        echo "<span style='color: #ffffff;'>Item Update Successful $checkIfExist</span>";
                    } else {
                        echo "<span style='color: #ffffff;'>Update Unsuccessful $checkIfExist</span>";
                    }
                }

            }
        }
    }
}

$callClass  = new MoveInventoryToShop();
$callMethod = $callClass->moveToShop();
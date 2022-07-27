<?php
session_start();

class QuickStockShop{
    public static function moveThisToShop(){
        $error = false;
        $getToken = trim($_POST['tkn']);
        if (isset($_SESSION['quick_stock_shop']) && $_SESSION['quick_stock_shop'] == $getToken){
            

            $product_name       = trim($_POST['product_name']);
            //$storage_ID         = trim($_POST['storage_ID']);
            $product_code       = trim($_POST['product_code']);
            $received_qty       = trim($_POST['received_qty']);
            //$transfer_qty       = strip_tags(trim($_POST['transfer_qty']));
            //$po_ID              = trim($_POST['po_ID']);
            $unit_cost          = trim($_POST['unit_cost']);
            //$wh_stored          = trim($_POST['wh_stored']);
            //$storage_address    = trim($_POST['storage_address']);
            $batch_num          = trim($_POST['batch_num']);
            //$trans_reason       = strip_tags(trim($_POST['trans_reason']));
            $dy                 = Date('d');
            $mn                 = Date('m');
            $yr                 = Date('Y');
            $addedBy            = $_SESSION['uid'];
            $store_name         = trim($_POST['store_name']);
            $branch             = $_POST['branch_owner'];
            $inventory_cat      = strip_tags(trim($_POST['inventory_cat']));
            $inventory_sub_cat  = strip_tags(trim($_POST['inventory_sub_cat']));
            //$barcode            = strip_tags(trim($_POST['barcode']));
            $expiry_dt          = Date('Y-m-d', strtotime($_POST['expiry_dt']));
            $manu_dt            = Date('Y-m-d', strtotime($_POST['manu_dt']));

            $merchant_ID        = $_SESSION['merchant_ID'];


            $tbl_a               = 'sales_stock';
            $tbl_b              = 'product_storage_tbl';

            require_once '../model/MDLMoveThisItemsQuick.php';
            $checkIfExist       = MDLMoveThisItemsQuick::checkIfItemExist($tbl_a, $product_code);
            //$cntItems         = $checkIfExist->rowCount();

            if (empty($received_qty)){
                $error  = true;
                echo "Quantity to Stock cannot be empty";
            }

            elseif ($received_qty <= 0){
                $error = true;
                echo "Transfer Quantity must be above Zero(0)";
            }
            elseif ($store_name == "999"){
                $error  = true;
                echo "Please select a Shop";
            }

            if (!$error){
                $data   = array(
                    'pn'=> $product_name,
                    'pc'=> $product_code,
                    'rq'=> $received_qty,
                    'ict' => $inventory_cat,
                    'isc'=> $inventory_sub_cat,
                    'uc'=> $unit_cost,
                    'snm'=> $store_name,
                    'bn'=> $batch_num,
                    'd'=> $dy,
                    'm'=> $mn,
                    'y'=> $yr,
                    'adb'=> $addedBy,
                    'brn' => $branch,
                    'exp' => $expiry_dt,
                    'mnd'=> $manu_dt,
                    'md' => $merchant_ID
                );

                if ($checkIfExist < 1) {
                    if (MDLMoveThisItemsQuick::moveThisToStoreQuick($tbl_a, $tbl_b, $data)) {
                        echo "Item Transfer Successful $manu_dt";
                    } else {
                        echo "Transfer Unsuccessful $manu_dt";
                    }
                }

                elseif ($checkIfExist > 0){
                    if (MDLMoveThisItemsQuick::updateShopItems($tbl, $data)) {
                        echo "Item Update Successful";
                    } else {
                        echo "Update Unsuccessful";
                    }
                }

            }
        }
        else {
            echo "Action Not Permitted";
        }
    }
}

QuickStockShop::moveThisToShop();
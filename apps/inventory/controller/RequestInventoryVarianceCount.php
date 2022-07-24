<?php

session_start();
class RequestInventoryVarianceCount
{
    static public function requestItemScrap(){

        $error      = false;
        $getToken   = trim($_POST['tkn']);
        if (isset($_SESSION['countVarianceToken']) && $_SESSION['countVarianceToken'] == $getToken){
            $product_name       = trim($_POST['product_name']);
            $storage_ID         = trim($_POST['storage_ID']);
            $product_code       = trim($_POST['product_code']);
            $received_qty       = trim($_POST['received_qty']);
            $variance_qty       = strip_tags(trim($_POST['variance_qty']));
            $po_ID              = trim($_POST['po_ID']);
            $unit_cost          = trim($_POST['unit_cost']);
            $wh_stored          = trim($_POST['wh_stored']);
            $storage_address    = trim($_POST['storage_address']);
            $batch_num          = trim($_POST['batch_num']);
            $variance_reason    = strip_tags(trim($_POST['variance_reason']));
            $dy                 = Date('d');
            $mn                 = Date('m');
            $yr                 = Date('Y');
            $addedBy            = $_SESSION['uid'];
            $branch             = $_SESSION['branch_name'];

            $adjustment_value   = (float)$received_qty - (float)$variance_qty;
            //$raw_adjustment_val = substr($adjustment_value, 1);

            $total_affected_value = (float)$unit_cost * (float)((float)$received_qty - (float)$variance_qty);

            $trans_action       = '';
            if ($received_qty > $variance_qty){
                $trans_action .= '-';
            }
            elseif ($variance_qty > $received_qty){
                $trans_action .= '+';
            }

            $tbl                = 'count_variance';

            if (is_null($variance_qty)){
                $error  = true;
                echo "Variance Quantity cannot be empty";
            }


            elseif (empty($variance_reason)){
                $error  = true;
                echo "Please provide a reason for the difference";
            }

            if (!$error){
                $data   = array(
                    'pn'=> $product_name,
                    'sd'=> $storage_ID,
                    'pc'=> $product_code,
                    'rq'=> $received_qty,
                    'vq'=> $variance_qty,
                    'pd'=> $po_ID,
                    'uc'=> $unit_cost,
                    'wh'=> $wh_stored,
                    'sad'=> $storage_address,
                    'bn'=> $batch_num,
                    'vr'=> $variance_reason,
                    'd'=> $dy,
                    'm'=> $mn,
                    'y'=> $yr,
                    'adb'=> $addedBy,
                    'adv'=> $adjustment_value,
                    'tav' => $total_affected_value,
                    'tra'=> $trans_action,
                    'brn' => $branch
                );
                require_once '../model/RequestInventoryMgtMdl.php';
                if (RequestInventoryMgtMdl::countVarianceRequest($tbl, $data)){
                    echo "Entry Successful";
                }
                else{
                    echo "Entry Unsuccessful";
                }
            }


        }
        else{
            echo "Action Not Permitted";
        }
    }
}

RequestInventoryVarianceCount::requestItemScrap();
<?php

session_start();
class RequestInventoryScrap
{
    static public function requestItemScrap(){
        //$_SESSION['scrapToken'];
        $error      = false;
        $getToken   = trim($_POST['tkn']);
        if (isset($_SESSION['scrapToken']) && $_SESSION['scrapToken'] == $getToken){
            $product_name       = trim($_POST['product_name']);
            $storage_ID         = trim($_POST['storage_ID']);
            $product_code       = trim($_POST['product_code']);
            $received_qty       = trim($_POST['received_qty']);
            $scrap_qty          = strip_tags(trim($_POST['scrap_qty']));
            $po_ID              = trim($_POST['po_ID']);
            $unit_cost          = trim($_POST['unit_cost']);
            $wh_stored          = trim($_POST['wh_stored']);
            $storage_address    = trim($_POST['storage_address']);
            $batch_num          = trim($_POST['batch_num']);
            $scrap_reason       = strip_tags(trim($_POST['scrap_reason']));
            $dy                 = Date('d');
            $mn                 = Date('m');
            $yr                 = Date('Y');
            $addedBy            = $_SESSION['uid'];
            $branch             = $_SESSION['branch_name'];

            $tbl                = 'scrap_inventory_tbl';

            if (empty($scrap_qty)){
                $error  = true;
                echo "Quantity to Scrap cannot be empty";
            }

            elseif ($scrap_qty <= 0){
                $error = true;
                echo "Scrap Quantity must be above Zero(0)";
            }

            elseif (empty($scrap_reason)){
                $error  = true;
                echo "Please provide a reason for scrapping";
            }

            if (!$error){
                $data   = array(
                    'pn'=> $product_name,
                    'sd'=> $storage_ID,
                    'pc'=> $product_code,
                    'rq'=> $received_qty,
                    'sq'=> $scrap_qty,
                    'pd'=> $po_ID,
                    'uc'=> $unit_cost,
                    'wh'=> $wh_stored,
                    'sad'=> $storage_address,
                    'bn'=> $batch_num,
                    'sr'=> $scrap_reason,
                    'd'=> $dy,
                    'm'=> $mn,
                    'y'=> $yr,
                    'adb'=> $addedBy,
                    'brn' => $branch
                );
                require_once '../../model/inventory/RequestInventoryMgtMdl.php';
                if (RequestInventoryMgtMdl::scrapRequest($tbl, $data)){
                    echo "<span style='color: #ffffff;'>Entry Successful</span>";
                }
                else{
                    echo "<span style='color: #ffffff;'>Entry Unsuccessful</span>";
                }
            }


        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted</span>";
        }
    }
}

$callClass  = new RequestInventoryScrap();
$callMethod = $callClass->requestItemScrap();
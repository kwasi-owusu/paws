<?php

session_start();
class SaveInventoryItems
{
    static public function createInventoryItems(){
        require_once ('../model/InventoryModel.php');

        $getToken   = trim($_POST['tkn']);
        $error      = false;
        if (isset($_SESSION['inventory_control_token']) && $_SESSION['inventory_control_token'] == $getToken){
            $product_cat            = trim($_POST['product_cat']);
            $inventory_sub_cat      = trim($_POST['inventory_sub_cat']);
            $get_itm_brand          = trim($_POST['get_itm_brand']);
            $inventory_code         = trim($_POST['inventory_code']);
            $inventory_name         = trim($_POST['inventory_name']);
            $re_order_rule          = trim($_POST['re_order_rule']);
            $uom                    = trim($_POST['uom']);

            $inventory_desc         = trim($_POST['inventory_desc']);
            $sellable               = '';
            $enable_desc            = '';
            $added_by               = '1';
            $prod_prefix            = $inventory_code;
            $Internal_ref           = trim($_POST['Internal_ref']);

            
            //$mime_type              = '';
            $imgContent             = '';

            $file_size = $_FILES['item_img']['size'];
            $fileError = $_FILES['item_img']['error'];
            if ($file_size != 0 && $fileError != 4) {

                $mime_type      = mime_content_type($_FILES['item_img']['tmp_name']);
                $target_file    = basename($_FILES["item_img"]["name"]);

                $image_base64   = base64_encode(file_get_contents($_FILES['item_img']['tmp_name']));
                $imgContent     .= 'data:image/'.$mime_type.';base64,'.$image_base64;

            }

            $allowed_file_types = ['image/png', 'image/jpeg'];
            if ($file_size != 0 && $fileError != 4 && !in_array($mime_type, $allowed_file_types)) {
                $error = true;
                echo "Uploaded file not accepted";
            }


            if (isset($_POST['sellable'])){
                $sellable           .= $_POST['sellable'];
            }
            else{
                $sellable           .= '0';
            }
            if (isset($_POST['enable_desc'])){
                $enable_desc        .= $_POST['enable_desc'];
            }
            else{
                $enable_desc        .= '0';
            }

            if (empty($inventory_code)){
                $error      = true;
                echo "Inventory Code Cannot be empty";
            }
            elseif (empty($inventory_name)){
                $error      = true;
                echo "Inventory Name Cannot be empty";
            }

            elseif (empty($re_order_rule)){
                $error      = true;
                echo "Re-Order Rule Cannot be empty";
            }
            elseif (empty($inventory_desc)){
                $error      = true;
                echo "Inventory Description Cannot be empty";
            }



            elseif (!$error){

                $tbl        = 'inventory_master';
                $folder     = "uploads";
                $merchant_ID = $_SESSION['merchant_ID'];
                $data       = array(
                    'pct'=>$product_cat,
                    'isc'=>$inventory_sub_cat,
                    'itb'=>$get_itm_brand,
                    'ivc'=>$inventory_code,
                    'ivn'=>$inventory_name,
                    'ror'=>$re_order_rule,
                    'uo'=>$uom,
                    'ivd'=>$inventory_desc,
                    'sll'=>$sellable,
                    'edc'=>$enable_desc,
                    'adb'=>$added_by,
                    'pp'=>$prod_prefix,
                    'inr'=>$Internal_ref,
                    'ig' => $imgContent,
                    'md' =>$merchant_ID

                );
                if (InventoryModel::addInventoryItem($tbl, $data)){
                    echo "Entry Successful.";
                } else {
                    echo "Entry Unsuccessful";
                }
            }

        }
        else{
            echo "Sorry. Action not permitted";
        }
    }
}

SaveInventoryItems::createInventoryItems();
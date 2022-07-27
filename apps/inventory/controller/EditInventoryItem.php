<?php
session_start();
class EditInventoryItem
{
    public static function editItemMaster()
    {
        require_once('../model/InventoryModel.php');
        $getToken   = trim($_POST['tkn']);
        $error      = false;
        if (isset($_SESSION['editInventoryItemsCors']) && $_SESSION['editInventoryItemsCors'] == $getToken) {
            $product_cat            = trim($_POST['product_cat']);
            $inventory_ID            = trim($_POST['inventory_ID']);
            $inventory_sub_cat      = trim($_POST['inventory_sub_cat']);
            $get_itm_brand          = trim($_POST['get_itm_brand']);
            $inventory_code         = trim($_POST['inventory_code']);
            $inventory_name         = trim($_POST['inventory_name']);
            $re_order_rule          = trim($_POST['re_order_rule']);
            $uom                    = trim($_POST['uom']);
            $unit_cost              = strip_tags(trim($_POST['unit_cost']));
            //$img_nm                 = $_FILES['item_img']['name'];
            //$inventory_desc         = trim($_POST['inventory_desc']);
            $sellable               = '';
            $enable_desc            = '';
            $added_by               = $_SESSION['uid'];
            //$prod_prefix            = trim($_POST['prod_prefix']);
            $Internal_ref           = trim($_POST['Internal_ref']);

            if (isset($_POST['sellable'])) {
                $sellable           .= $_POST['sellable'];
            } else {
                $sellable           .= '0';
            }
            if (isset($_POST['enable_desc'])) {
                $enable_desc        .= $_POST['enable_desc'];
            } else {
                $enable_desc        .= '0';
            }

            if (empty($inventory_code)) {
                $error      = true;
                echo "Inventory Code Cannot be empty";
            } elseif (empty($inventory_name)) {
                $error      = true;
                echo "Inventory Name Cannot be empty";
            } elseif (empty($re_order_rule)) {
                $error      = true;
                echo "Re-Order Rule Cannot be empty";
            } elseif (empty($unit_cost)) {
                $error      = true;
                echo "Unit Cost Cannot be empty";
            }

            $mime_type              = '';
            $imgContent             = NULL;

            $file_size = $_FILES['item_img']['size'];
            $fileError = $_FILES['item_img']['error'];
            if ($file_size != 0 && $fileError != 4) {
                $mime_type .= mime_content_type($_FILES['item_img']['tmp_name']);

                $target_file    = basename($_FILES["item_img"]["name"]);
                $image_base64   = base64_encode(file_get_contents($_FILES['item_img']['tmp_name']));
                $imgContent     .= 'data:image/' . $mime_type . ';base64,' . $image_base64;
            }

            $allowed_file_types = ['image/png', 'image/jpeg'];
            if ($file_size != 0 && $fileError != 4 && !in_array($mime_type, $allowed_file_types)) {
                $error = true;
                echo '<span style="color: #ffffff;">Uploaded file not allowed';
            } elseif (!$error) {
                $tbl        = 'inventory_master';
                $folder     = "uploads";
                $lastUpdateBy   = $_SESSION['uid'];
                $lastUpdateOn   = Date('Y-m-d');
                $data       = array(
                    'pct' => $product_cat,
                    'ind' => $inventory_ID,
                    'isc' => $inventory_sub_cat,
                    'itb' => $get_itm_brand,
                    'ivc' => $inventory_code,
                    'ivn' => $inventory_name,
                    'ror' => $re_order_rule,
                    'uo' => $uom,
                    'sll' => $sellable,
                    'edc' => $enable_desc,
                    'lb' => $lastUpdateBy,
                    'ln' => $lastUpdateOn,
                    'inr' => $Internal_ref,
                    'ig' => $imgContent,
                    'unc' => $unit_cost,
                    'md'=> $_SESSION['merchant_ID']

                );

                $getThisItemBeforeEdit  = InventoryModel::loadThisInventoryItem($tbl, $data);
                $fetch_assoc            = $getThisItemBeforeEdit->fetch(PDO::FETCH_ASSOC);
                $edited_trail_tbl       = "inventory_master_edit_trail";
                $data_owner             = $_SESSION['merchant_ID'];
                $branch_owner           = $_SESSION['branch_name'];
                $original_data          = array(
                    'ind' => $inventory_ID,
                    'ivc' => $inventory_code,
                    'oct' => $fetch_assoc['inventory_cat_ID'],
                    'osb' => $fetch_assoc['invenotory_sub_cat_ID'],
                    'obr' => $fetch_assoc['inventory_brand'],
                    'onm' => $fetch_assoc['inventory_name'],
                    'um'  => $fetch_assoc['base_uom'],
                    'rr'  => $fetch_assoc['re_order_rule'],
                    'slb' => $fetch_assoc['sellable'],
                    'dcs' => $fetch_assoc['enable_desc'],
                    'inf' => $fetch_assoc['Internal_ref'],
                    'itg' => $fetch_assoc['item_img'],
                    'adb' => $fetch_assoc['addedBy'],
                    'dto' => $data_owner,
                    'bro' => $branch_owner,
                    'unc'=>$fetch_assoc['unit_cost']
                );

                if (InventoryModel::editInventoryItem($tbl, $data, $folder, $edited_trail_tbl, $original_data)) {
                    echo "Update Successful.";
                } else {
                    echo "Update Unsuccessful ";
                }
            }
        } else {
            echo "Sorry. Action not permitted";
        }
    }
}

EditInventoryItem::editItemMaster();

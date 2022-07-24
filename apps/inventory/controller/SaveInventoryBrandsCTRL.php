<?php
session_start();
class SaveInventoryBrandsCTRL
{

    public static function saveInventoryBrands()
    {
        require_once('../model/InventoryModel.php');
        $getToken   = trim($_POST['tkn']);
        $error      = false;

        if (isset($_SESSION['inventory_control_token']) && $_SESSION['inventory_control_token'] == $getToken) {

            $name    = strip_tags(trim($_POST['brand_name']));
            $meta_description    = strip_tags(trim($_POST['meta_description']));

            if (empty($name)) {
                $error = true;
                echo "Brand name is required.";
            }

            $code = rand(1, date('Y')) * rand(1, date('Y'));
            $for_slug = $code . "/" . $name;


            function php_slug($string)
            {
                $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower($string));
                return $slug;
            }

            $name_slug = php_slug($for_slug);

            $imgContent             = '';

            $file_size = $_FILES['brand_img']['size'];
            $fileError = $_FILES['brand_img']['error'];
            if ($file_size != 0 && $fileError != 4) {

                $mime_type      = mime_content_type($_FILES['brand_img']['tmp_name']);
                $target_file    = basename($_FILES["brand_img"]["name"]);

                $image_base64   = base64_encode(file_get_contents($_FILES['brand_img']['tmp_name']));
                $imgContent     .= 'data:image/' . $mime_type . ';base64,' . $image_base64;
            }

            $allowed_file_types = ['image/png', 'image/jpeg'];
            if ($file_size != 0 && $fileError != 4 && !in_array($mime_type, $allowed_file_types)) {
                $error = true;
                echo "Uploaded file not accepted";
            } elseif (!$error) {

                $tbl        = 'brands';

                $data       = array(
                    'nm' => $name,
                    'mdc' => $meta_description,
                    'ig' => $imgContent,
                    'slg' => $name_slug

                );

                if (InventoryModel::saveInventoryBrand($tbl, $data)) {
                    echo "Entry Successful.";
                } else {
                    echo "Entry Unsuccessful". $imgContent;
                }
            }
        } else {
            echo "Sorry. Action not permitted";
        }
    }
}

SaveInventoryBrandsCTRL::saveInventoryBrands();

<?php


class GetSubCatController
{
    static public function getSubCategory(){
        $getCat = trim($_POST['sbc']);
        if ($getCat != 999){
            $tbl    = 'inventory_sub_cat';
            $data   = array(
              'ct'=>$getCat
            );
            require_once ('../../model/inventory/GetInventorySubCategory.php');
            $rqsModel = GetInventorySubCategory::loadSubCat($tbl, $data);
            if (isset($rqsModel)) {
                foreach ($rqsModel as $sct) {
                    $subCat     = $sct['sub_cat_name'];
                    $subCatID   = $sct['sub_cat_ID'];
                    echo "<option value='" . $subCatID . "'>$subCat</option>";

                }
            } else {

                echo "<option value='999'>No Sub Category Available</option>";

            }
        }
    }
}

$calClass   = new GetSubCatController();
$callMethod = $calClass->getSubCategory();
<?php
class GetShopController{
    public static function getShopBasedOnBranch(){
        $getBranch = trim($_POST['brn']);
        if (isset($getBranch)){
            $tbl    = 'pos_store';
            $data   = array(
              'brn'=>$getBranch
            );
            require_once ('../model/GetShopBasedOnBranchMDL.php');
            $rqsModel = GetShopBasedOnBranchMDL::loadAllShopsByBranch($tbl, $data);
            if (isset($rqsModel)) {
                foreach ($rqsModel as $sct) {
                    $store_name     = $sct['store_name'];
                    $store_ID   = $sct['store_ID'];
                    echo "<option value='" . $store_ID . "'>$store_name</option>";

                }
            } else {

                echo "<option value='999'>No Shop Available</option>";

            }
        }
        else {
            echo "<option value='999'>No Shop Available</option>";
            
        }
    }
}
GetShopController::getShopBasedOnBranch();
<?php


class GetInventoryCode
{
    static public function doInventoryCode(){
        require_once('../../model/purchases/ShowInventoryCode.php');
        $tbl        = 'inventory_master';
        $getCode    = $_POST['prod_name'];
        $getRst     = ShowInventoryCode::inventoryCodeSearch($tbl, $getCode);

        foreach ($getRst as $pd){
            $data["ivk"] = $pd['inventory_code'];
//            $data["total_code"]			= $rrow["product_code"];
            echo json_encode($data);
        }

    }
}

$callClass      = new GetInventoryCode();
$callMethod     = $callClass->doInventoryCode();
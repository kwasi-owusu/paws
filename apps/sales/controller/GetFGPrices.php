<?php


class GetFGPrices
{
    static public function doFGPrices(){
        require_once('../../model/sales/ShowInventoryPrice.php');
        $tbl        = 'inventory_master';
        $getCode    = $_POST['prod_name'];
        $getRst     = ShowInventoryPrice::inventoryPriceSearch($tbl, $getCode);

        foreach ($getRst as $pd){
            $data["prc"] = $pd['unit_value'];
            echo json_encode($data);
        }

    }
}

$callClass  = new GetFGPrices();
$calMethod  = $callClass->doFGPrices();
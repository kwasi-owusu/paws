<?php


class GetMaterialPrices
{

    static public function doRMPrices()
    {
        require_once('../../model/purchases/ShowRMPrices.php');
        $tbl = 'inventory_master';
        $getCode = $_POST['prod_name'];
        $getRst = ShowRMPrices::RMInventoryPriceSearch($tbl, $getCode);

        foreach ($getRst as $pd) {
            $data["prc"] = $pd['unit_value'];
            echo json_encode($data);
        }
    }
}

$callClass = new GetMaterialPrices();
$calMethod = $callClass->doRMPrices();

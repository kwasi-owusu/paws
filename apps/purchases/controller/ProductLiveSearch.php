<?php


class ProductLiveSearch
{
    static public function doLiveProductSearch(){
        require_once('../../model/purchases/ShowLiveProductSearch.php');
        $tbl        = 'inventory_master';
        $getRst     = ShowLiveProductSearch::productLiveSearch($tbl);


        while ($row = $getRst->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row['inventory_name'];
        }

        echo json_encode($data);

    }
}

$callClass  = new ProductLiveSearch();
$callMethod = $callClass->doLiveProductSearch();
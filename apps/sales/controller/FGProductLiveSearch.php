<?php


class FGProductLiveSearch
{
    static public function doLiveFGProductSearch(){
        require_once('../../model/sales/ShowLiveFGProductSearch.php');
        $tbl        = 'inventory_master';
        $getRst     = ShowLiveFGProductSearch::FGProductLiveSearch($tbl);


        while ($row = $getRst->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row['inventory_name'];
        }
        echo json_encode($data);


    }
}

$callClass      = new FGProductLiveSearch();
$callMethod     = $callClass->doLiveFGProductSearch();
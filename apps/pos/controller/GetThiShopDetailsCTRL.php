<?php
session_start();
class GetThiShopDetailsCTRL{
    public static function callThisStores($shop_ID){

        require_once ('../../model/ThisShopDetails.php');
        $tbl        = 'pos_store';
        $user_type = $_SESSION['user_type'];
        $data   = array(
            'sd' => $shop_ID,
            'ust'=> $user_type,
            'md'=> $_SESSION['merchant_ID']
        );
        $getRst     = ThisShopDetails::loadThisShops($tbl, $data);

        return $getRst;
    }
}
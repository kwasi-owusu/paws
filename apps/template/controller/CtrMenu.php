<?php
Class CtrMenu{
    public static function MenuCtrl(){
        
        $table      = 'menus';
        $table_b    = 'sub_menu';
        $table_c    = 'packages';  
        $table_d    = 'user_permission_menu';
        $table_e    = 'merchants';
        $merchant_ID    = $_SESSION['merchant_ID'];
        $user_ID    = $_SESSION['uid'];
        $userRole   = $_SESSION['user_type'];

        $current_package = '';
        
        require_once '../../template/model/Menu.php';
        require_once '../../merchants/model/Merchants.php';

        if($userRole != 1){
        $getMerchant    = Merchants::thisMerchants($merchant_ID);
        $fetchMerchant  = $getMerchant->fetch(PDO::FETCH_ASSOC);

        $current_package    .= $fetchMerchant['current_package'];
        }

        $data = array(
            'md' => $merchant_ID ,
            'usr' => $userRole,
            'pkg' => $current_package,
            'uid' => $user_ID
        );
        
        $getRst     = Menu::createMenu($table, $table_b, $table_c, $table_d, $table_e, $data);

        return $getRst;
    }

    public static function subMenuCtr($menu_ID){
        require_once '../../template/model/Menu.php';
        
        $table_b        = 'sub_menu';
        //$merchant_ID    = $_SESSION['merchant_ID'];
        $userRole       = $_SESSION['user_type'];
        $user_ID        = $_SESSION['uid'];
        $table_d    = 'user_permission_menu';

                
        $getRst     = Menu::subMenu($menu_ID, $table_b, $table_d, $userRole, $user_ID);

        return $getRst;
    }
}

?>
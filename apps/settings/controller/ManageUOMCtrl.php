<?php
session_start();
require_once ('../../model/settings/ManageUOMMdl.php');
class ManageUOMCtrl extends ManageUOMMdl
{
    static public function manageThisUOM(){
        $getToken   = trim($_POST['uom_edit_tkn']);
        $error      = false;

        if (isset($_SESSION['uomEditTkn']) && $_SESSION['uomEditTkn'] == $getToken) {
            $tbl = 'uom_conversion_tbl';

            $inventory_ID = strip_tags(trim($_POST['inventory_ID']));
            $related_trans = strip_tags(trim($_POST['related_trans']));
            $base_uom   = strip_tags(trim($_POST['base_uom']));
            //$uom_ID     = strip_tags(trim($_POST['uom_ID']));
            $related_uom = strip_tags(trim($_POST['related_uom']));
            $conversion_fig = strip_tags(trim($_POST['conversion_fig']));
            $addedBy    = $_SESSION['uid'];

            if ($related_trans == "000"){
                $error = true;
                echo "<span>Please Select a Transaction Type</span>";
            }

            if (!empty($base_uom) && !empty($related_uom) && !empty($conversion_fig)) {

                $data = array(
                    'bu' => $base_uom,
                    'ru'=> $related_uom,
                    'cv'=> $conversion_fig,
                    'adb'=> $addedBy,
                    'ivd'=>$inventory_ID,
                    'rtr'=> $related_trans

                );
                if (!$error){
                    if (ManageUOMMdl::manageUOM($tbl, $data)){
                        echo "<span style='color: #ffffff;'>Conversion Setup Successful</span>";
                    }
                    else{
                        echo "<span style='color: #ffffff;'>Conversion Setup Unsuccessful</span>";
                    }
                }
            }
            else{
                echo "<span style='color: #ffffff;'>All Fields are required</span>";
            }
        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted</span>";
        }
    }
}

$callClass  = new ManageUOMCtrl();
$CallMethod = $callClass->manageThisUOM();

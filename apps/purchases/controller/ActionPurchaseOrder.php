<?php

session_start();
class ActionPurchaseOrder
{
    static public function actOnPO(){
        $error          = false;
        $getToken       = trim($_POST['po_action_tkn']);
        if (isset($_SESSION['poActionToken']) && $_SESSION['poActionToken'] == $getToken){
            $po_ID      = trim($_POST['po_ID']);
            $po_action  = trim($_POST['po_action']);
            $action_comment     = trim($_POST['action_comment']);
            $clean_comment      = filter_var($action_comment, FILTER_SANITIZE_STRING);
            $var_comment        = strip_tags($clean_comment);

            //$po_type            = trim($_POST['po_type']);


            //get total approval limit
            require_once('../../model/purchases/POActions.php');
            $tbl            = 'new_purch_oder';
            $tbl_b          = 'po_approvals';

            $thisPO         = POActions::thisPODetails($tbl, $po_ID);
            $fetchPO        = $thisPO->fetch(PDO::FETCH_ASSOC);

            $approval_limit     = $fetchPO['approval_limit'];

            //approval details
            $approval_details   = POActions::thisPOApproval($tbl_b, $po_ID);
            $cntApprovals       = $approval_details->rowCount();

            //check if I have already approved
            $myID               = $_SESSION['uid'];
            $myApproval         = POActions::myPOApproval($tbl_b, $po_ID, $myID);
            $cntMyApproval      = $myApproval->rowCount();



            if ($cntMyApproval > 0){
                $error  = true;
                echo '<br><span style="color: #ffffff;">You have already approved this PO.</span>';
            }

//             if (!isset($po_ID)){
//                $error  = true;
//                echo '<br><span style="color: #f02e05;">Your Session Has Expired. Kindly refresh and login.</span>';
//            }

            elseif ($cntApprovals >= $approval_limit){
                $error  = true;
                echo '<br><span style="color: #ffffff;">Approval Limit Already Reached</span>';

            }

             elseif (!$error){
                 require_once('../../model/purchases/SavePOApprovals.php');
                 $approvalBy    = $_SESSION['uid'];
                 $data      = array(
                     'pid'=>$po_ID,
                     'pac'=>$po_action,
                     'cm'=>$var_comment,
                     'adb'=>$approvalBy,
                     'al'=>$approval_limit
                 );
                 if (SavePOApprovals::saveApprovals($tbl_b, $data)){
                     echo "<span style='color: #ffffff'>Action Successful.</span> ";

                     $actionsNos    = POActions::thisPOApproval($tbl_b, $po_ID);
                     $cntActions    = $actionsNos->rowCount();

                     if ($cntActions >= $approval_limit) {
                         SavePOApprovals::updateApprovalStatus($po_ID);
                     }

                 } else {
                     echo "<span style='color: #ffffff'>Action Unsuccessful</span>";
                 }
             }

        }
        else{
            echo '<br><div style="color: #ffffff;">Action not Permitted</div>';
        }
    }
}

$callClass      = new ActionPurchaseOrder();
$callMethod     = $callClass->actOnPO();
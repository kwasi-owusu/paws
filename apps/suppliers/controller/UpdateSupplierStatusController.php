<?php
session_start();
class UpdateSupplierStatusController
{
    static public function loadSingleSupplier(){
        require_once('../../model/suppliers/UpdateSupplierStatus.php');
        $error  = false;
        $tkn    = trim($_POST['tkn']);
        if (isset($_SESSION['supplierStatusTkn']) && $_SESSION['supplierStatusTkn'] == $tkn){
            $supplier_ID        = trim($_POST['supplier_ID']);
            $supplierStatus     = trim($_POST['supplierStatus']);

            if (empty($supplierStatus)){
                $error = true;
                echo "<span style='color: #b9090e'>Supplier Status Cannot be empty</span >";
            }
            elseif (!$error){
                $tbl    = 'suppliers';
                $lastUpdateBy = 1;
                $lastUpdateOn = Date('Y-m-d');
                $data   = array(
                    'ss'=>$supplierStatus,
                    'sd'=>$supplier_ID,
                    'lb'=>$lastUpdateBy,
                    'ln'=>$lastUpdateOn
                );
                if (UpdateSupplierStatus::editSupplierStatus($tbl, $data)){
                    echo "<span style='color: #1b901d'>Status Update Successful.</span>";
                } else {
                    echo "<span style='color: #b9090e'>Status Update Unsuccessful</span>";
                }
            }

        }
        else{
            echo "<span style='color: #b9090e'>Action not Permitted</span >";
        }
    }
}

$callClass     = new UpdateSupplierStatusController();
$CallMethod     = $callClass->loadSingleSupplier();
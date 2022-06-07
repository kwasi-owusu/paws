<?php

session_start();
class UpdateCustomerPipeline
{
    static public function updateThisPipeline(){
        if (isset($_SESSION['pipeline'])){

            $error      = false;
            $sourceId   = strip_tags(trim($_POST['sourceId']));
            $targetId   = strip_tags(trim($_POST['targetId']));
            $pipelineID = strip_tags(trim($_POST['pipeId']));

            if ($sourceId == 3){
                $error = true;
                echo "<span style='color: #ffffff;'>You cannot move Won Leads</span>";
            }

            if (!$error && $sourceId != '' && $targetId != ''){
                require_once '../../model/crm/PipelineMdl.php';
                $tbl        = 'sales_pipeline';
                $data       = array(
                    'sd' => $sourceId,
                    'td' => $targetId,
                    'pd' => $pipelineID
                );
                if ($getRst = PipelineMdl::updatePipeline($tbl, $data)){
                    echo "<span style='color: #ffffff;'>Sales Pipeline Update Successful</span>";
                }
                else{
                    echo "<span style='color: #ffffff;'>Sales Pipeline Update Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted </span>";
        }
    }
}

$callClass      = new UpdateCustomerPipeline();
$callMethod     = $callClass->updateThisPipeline();
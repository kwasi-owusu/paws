<?php

session_start();
class UpdateCustomerPipeline
{
    static public function updateThisPipeline(){

        $getToken = trim($_POST['pipeCors']);

        if (isset($_SESSION['pipeline']) && $_SESSION['pipeline'] == $getToken){

            $error      = false;
            $sourceId   = strip_tags(trim($_POST['sourcePipeline']));
            $targetId   = strip_tags(trim($_POST['targetPipeline']));
            $leadIdID   = strip_tags(trim($_POST['leadId']));

            if ($sourceId == "Closed Won"){
                $error = true;
                echo "<span>You cannot move Won Leads</span>";
            }

            if (!$error && $sourceId != '' && $targetId != ''){
                require_once('../model/PipelineMdl.php');
                $tbl        = 'sales_pipeline';
                $data       = array(
                    'sd' => $sourceId,
                    'td' => $targetId,
                    'pd' => $leadIdID
                );

                if (PipelineMdl::updatePipeline($tbl, $data)){
                    echo "<span>Sales Pipeline Update Successful</span>";
                }
                else{
                    echo "<span>Sales Pipeline Update Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted </span>";
        }
    }
}

UpdateCustomerPipeline::updateThisPipeline();
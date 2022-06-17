<?php

//session_start();
require_once('../model/PipelineMdl.php');
require_once('../model/AllSaleLeads.php');
class GetAllSalesLead extends PipelineMdl
{
    public static function callAllSalesLeads()
    {
        
        $tbl            = 'sales_lead';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type']
        );

        $getRst         = AllSaleLeads::SalesLeads($tbl, $data);

        return $getRst;
    }

    public static function getAllProspectingPipeline(){

        $lead_stage = "Prospecting";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getSalesPipeline($tbl, $data);

        return $getRst;
    }

    public static function getAllQualifyingPipeline(){

        $lead_stage = "Qualifying";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getSalesPipeline($tbl, $data);

        return $getRst;
    }

    public static function getAllContactingPipeline(){

        $lead_stage = "Contacting";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getSalesPipeline($tbl, $data);

        return $getRst;
    }
    
    public static function getAlNegotiationPipeline(){

        $lead_stage = "Negotiation";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getSalesPipeline($tbl, $data);

        return $getRst;
    }
    
    public static function getWonPipeline(){

        $lead_stage = "Closed Won";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getSalesPipeline($tbl, $data);

        return $getRst;
    }
    
    
    public static function getLostPipeline(){

        $lead_stage = "Closed Lost";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getSalesPipeline($tbl, $data);

        return $getRst;
    }


    public static function getProspectingPipelineValue(){

        $lead_stage = "Prospecting";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getPipelineValue($tbl, $data);

        return $getRst;
    }

    public static function getQualifyingPipelineValue(){

        $lead_stage = "Qualifying";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getPipelineValue($tbl, $data);

        return $getRst;
    }
    
    public static function getContactingPipelineValue(){

        $lead_stage = "Contacting";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getPipelineValue($tbl, $data);

        return $getRst;
    }
    
    public static function getNegotiationPipelineValue(){

        $lead_stage = "Negotiation";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getPipelineValue($tbl, $data);

        return $getRst;
    }
    
    public static function getClosedWonPipelineValue(){

        $lead_stage = "Closed Won";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getPipelineValue($tbl, $data);

        return $getRst;
    }
    
    public static function getClosedLostPipelineValue(){

        $lead_stage = "Closed Lost";
        $tbl            = 'sales_pipeline';
        $data = array(
            'm' => $_SESSION['uid'],
            'md' => $_SESSION['merchant_ID'],
            'ust'=> $_SESSION['user_type'],
            'stage' => $lead_stage
        );

        $getRst         = PipelineMdl::getPipelineValue($tbl, $data);

        return $getRst;
    }
    
}

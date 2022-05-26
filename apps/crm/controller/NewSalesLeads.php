<?php

session_start();
class NewSalesLeads
{
    static public function addSalesLead()
    {
        $getToken   = strip_tags(trim($_POST['tkn']));
        $error      = false;

        if (isset($_SESSION['addSalesLeadTkn']) && $_SESSION['addSalesLeadTkn'] == $getToken) {
            $lead_name      = strip_tags(trim($_POST['lead_name']));
            $lead_source    = strip_tags(trim($_POST['lead_source']));
            $lead_email     = strip_tags(trim($_POST['lead_email']));
            $lead_phone     = strip_tags(trim($_POST['lead_phone']));
            $lead_type      = strip_tags(trim($_POST['lead_type']));
            $potential_opportunity   = strip_tags(trim($_POST['potential_opportunity']));
            $chance_of_sales  = strip_tags(trim($_POST['chance_of_sales']));
            $forecast_close  = strip_tags(trim($_POST['forecast_close']));
            $weighted_forecast  = strip_tags(trim($_POST['weighted_forecast']));


            if (empty($lead_name)) {
                $error = true;
                echo "<span style='color: #ffffff'>Lead Name Cannot be empty</span >";
            } elseif (empty($lead_source)) {
                $error = true;
                echo "<span style='color: #ffffff'>Lead Source Cannot be empty</span >";;
            } elseif (empty($lead_email)) {
                $error = true;
                echo "<span style='color: #ffffff'>Lead Email Cannot be empty</span>";
            } elseif (empty($lead_phone)) {
                $error = true;
                echo "<span style='color: #ffffff'>Lead Phone cannot be empty</span>";
            } elseif (empty($lead_type)) {
                $error = true;
                echo "<span style='color: #ffffff'>Lead Type cannot be empty</span>";
            } elseif (empty($potential_opportunity)) {
                $error = true;
                echo "<span style='color: #ffffff'>Potential Opportunity cannot be empty</span >>";
            } elseif (empty($chance_of_sales)) {
                $error = true;
                echo "<span style='color: #ffffff'> Chance of Sales cannot be empty</span >>";
            } elseif (empty($forecast_close)) {
                $error = true;
                echo "<span style='color: #ffffff'>Forecast close cannot be empty</span >>";
            } elseif (empty($weighted_forecast)) {
                $error = true;
                echo "<span style='color: #ffffff'>Weighted forecast cannot be empty</span >>";
            } elseif (!$error) {
                
                require_once('../model/SalesLeadModel.php');
                $tbl    = 'sales_lead';
                $addedBy            = $_SESSION['uid'];
                $merchant_ID     = $_SESSION['merchant_ID'];
                $data   = array(
                    'ldn' => $lead_name,
                    'lds' => $lead_source,
                    'lde' => $lead_email,
                    'ldp' => $lead_phone,
                    'ldt' => $lead_type,
                    'ldo' => $potential_opportunity,
                    'ldc' => $chance_of_sales,
                    'ldf'=> $forecast_close,
                    'ldw' => $weighted_forecast,
                    'adb' => $addedBy,
                    'md' => $merchant_ID
                );

                if (SalesLeadModel::addNewLead($tbl, $data)) {
                    echo "<span style='color: #ffffff'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #ffffff'>Entry Unsuccessful</span>";
                }
            }
        } else {
            echo "<span style='color: #ffffff'>Action not Permitted</span >";
        }
    }
}

NewSalesLeads::addSalesLead();

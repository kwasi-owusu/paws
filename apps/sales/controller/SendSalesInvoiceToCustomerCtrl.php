<?php

session_start();
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

require '../mailings/src/Exception.php';
require '../mailings/src/PHPMailer.php';
require '../mailings/src/SMTP.php';

class SendSalesInvoiceToCustomerCtrl
{
    static public function emailThisSalesInvoice(){
        $getToken   = trim($_POST['tkn']);
        if (isset($_SESSION['emailSOToken'] ) && $_SESSION['emailSOToken']  == $getToken) {

            $sales_order_ID          = $_POST['so_ID'];
            $emailSubject   = trim($_POST['emailSubject']);
            $emailBody      = trim($_POST['emailBody']);
            $customer_email = $_POST['customer_email'];

            require_once 'SoDetailsForEmail.php';

            $fetchSOItems   = SoDetailsForEmail::getSODetails($sales_order_ID);
            $fetchDetails   = $fetchSOItems->fetchAll();

            $fetchDetailsAssoc  = SoDetailsForEmail::getSODetails($sales_order_ID);
            $pdt                = $fetchDetailsAssoc->fetch(PDO::FETCH_ASSOC);

            $customer_name      = $pdt['customa_name'];
            $customa_address1   = $pdt['customa_address1'];
            $customa_phone      = $pdt['customa_phone'];
            //$customa_email      = $pdt['customa_email'];
            $order_No           = $pdt['order_No'];

// for taxes
            require_once '../../controller/settings/GetTaxesForEmail.php';

//individual tax
            $vat = GetTaxesForEmail::callVAT();
            $vtx = $vat->fetch(PDO::FETCH_ASSOC);
            $vatPercent = $vtx['tax_percent'] / 100;

            $nhl = GetTaxesForEmail::callNHIL();
            $nhx = $nhl->fetch(PDO::FETCH_ASSOC);
            $nhxPercent = $nhx['tax_percent'] / 100;

            $gtfn = GetTaxesForEmail::callGetFund();
            $gfx = $gtfn->fetch(PDO::FETCH_ASSOC);
            $gfxPercent = $gfx['tax_percent'] / 100;

            $covidTx = GetTaxesForEmail::callCovidTax();
            $cvd = $covidTx->fetch(PDO::FETCH_ASSOC);
            $cvdPercent = $cvd['tax_percent'] / 100;

            require_once '../../view/assets/tcpdf/tcpdf.php';


// create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Rails ERP');
            $pdf->SetTitle('Sales Invoice');
            $pdf->SetSubject('Sales InvoiceM');
            $pdf->SetKeywords('Sales Invoice, Rails ERP');


            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' ', PDF_HEADER_STRING, array(0, 7, 24), array(0, 64, 128));
            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//// set some language-dependent strings (optional)
//            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//                require_once(dirname(__FILE__) . '/lang/eng.php');
//                $pdf->setLanguageArray($l);
//            }

            $pdf->setFontSubsetting(true);


            $pdf->SetFont('dejavusans', '', 14, '', true);


            $pdf->AddPage('P');

// set text shadow effect
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            $output = "";
            $output .= '<div class="row" style="padding: 10px; margin-bottom: 15px;">
    <div class="col-md-12">
    <h1 style="text-align: center; text-decoration: underline;">SALES INVOICE</h1>
        <h5 style="font-weight: bold">INVOICE No.: ' . $order_No . '</h5>
        <h5>Currency: (' . $pdt["currency"] . ')</h5>
        
        <hr />
        <h5 style="text-transform: uppercase;">Customer</h5><p>'.$customer_name.'
        <br />
        '.$customa_address1.'
        <br />
        '.$customa_phone.'
        <br />
        '.$customer_email.'
        
        </p>
        <table class="table table-striped table-no-bordered table-hover thisTable"
                               style="width:100%; border: #666666; #fff0b3 solid thin 1px; padding: 5px; text-align: center;" border="2">
                            <thead class="thead-dark">
                            <tr style="border-bottom: #0f6674 solid 5px; font-size: small;">
                                <th>ITEM</th>
                                <th>QUANTITY</th>
                                <th>UNIT PRICE</th>
                                <th>TOTAL</th>
                                
                            </tr>
                            </thead>

                            <tbody>
                            ';
            foreach ($fetchDetails as $mt) {
                $output .= '<tr style="border-right-color:#666; border-weight:thin; border-right-width:1px; font-size: small">
                                   
                                    <td>' . $mt["product_name"] . '</td>
                                    <td>' . $mt["qty"] . '</td>
                                    <td>' . number_format($mt["unit_price"], 2) . '</td>
                                    <td>' . number_format($mt["subtotal"], 2) . '</td>
                                   </tr>
                                   </table>
                                   ';
            }
            $output .= '
<hr />
<p></p>
<table class="table table-striped table-no-bordered table-hover thisTable" style="width:100%">
            <tr style="font-weight: bolder;">
            <td colspan="2"></td>
                <td>Description</td>
                <td>Amount ('.$pdt["currency"].')</td>
            </tr>
            <tr>
            <td colspan="2"></td>
                <td>Sub Total</td>
                <td>'.number_format($pdt["sub_total"], 2).'</td>
            </tr>

            <tr>
            <td colspan="2"></td>
                <td>Discount(%)</td>
                <td>'. $pdt["disc_pcnt"].'</td>
            </tr>

                <tr>
                <td colspan="2"></td>
                    <td>NHIL ('.$nhx["tax_percent"].'%)</td>
                    <td>
                        '.$pdt["nhsAmount"].'
                    </td>
                </tr>


                <tr>
                <td colspan="2"></td>
                    <td>GetFund ('. $gfx["tax_percent"].'%)</td>
                    <td>
                        '. number_format($pdt["getFundAmount"], 2).'
                    </td>
                </tr>
                 
                 <tr>
                <td colspan="2"></td>
                    <td>Covid Levy ('. $cvd["tax_percent"].'%)</td>
                    <td>
                        '. number_format($pdt["covidAmount"], 2).'
                    </td>
                </tr>

                <tr>
                <td colspan="2"></td>
                    <td><span style="font-weight: bolder;">Sub Total</span></td>
                    <td>
                    '.$pdt["totalBeforeVAT"].'
                    </td>
                </tr>

                <tr>
                <td colspan="2"></td>
                    <td>VAT ('. $vtx["tax_percent"].'%)</td>
                    <td>
                        '. $pdt["vatAmount"].'
                    </td>
                </tr>


                <tr>
                <td colspan="2"></td>
                    <td><span style="font-weight: bolder;">Grand Total</span></td>
                    <td><span style="font-weight: bolder;">'. number_format($pdt["grandTotal"], 2).'</span>
                    </td>
                </tr>

        </table>
    </div>
    </div>
';
            $pdf->writeHTMLCell(0, 0, '', '', $output, 0, 1, 0, true, '', true);
            $attach_pdf = $pdf->Output('sales_invoice.pdf', 'S');
            if ($attach_pdf) {
                $mail = new PHPMailer\PHPMailer;                          // Passing `true` enables exceptions
                //try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = "mail.bahrimainfosystems.com ";
                //$mail->Host = gethostbyname('smtp.gmail.com');  	  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = "routemail@bahrimainfosystems.com";              // SMTP username
                $mail->Password = "vb~-fBp*^qffZYL2}E";             // SMTP password
                $mail->SMTPSecure = "ssl";                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                   // TCP port to connect to


                //Recipients
                $mail->setFrom('routemail@bahrimainfosystems.com', '');
                $mail->addAddress($customer_email);
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                $mail->AddStringAttachment($attach_pdf, 'purchase_order.pdf');        // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);   // Set email format to HTML
                $mail->Subject = $emailSubject;
                $mail->Body = $emailBody;
                $mail->AltBody = $emailBody;

                if ($mail->send()) {
                    echo 'Sales Invoice Mailed Successfully';
                } else {
                    echo '<span style="color: #ffffff;">Sales Invoice Could not be Sent. Please contact System Admin</span>';
                }

            }
        }
        else{
            echo "Action Not Permitted";
        }

    }
}

$callClass      = new SendSalesInvoiceToCustomerCtrl();
$callMethod     = $callClass->emailThisSalesInvoice();
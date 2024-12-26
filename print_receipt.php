<?php
// include 'isLoggedIn.php';
// include("../config/config.php");
include 'includes/isLogin.php';
if (!isset($_POST['school_fee'])) {
    $payment_type = $_GET['purpose'];
    include 'includes/database.php';
    $get_student =  "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = '$payment_type' AND session = '$session'";
    $run_otherpayment_paid = mysqli_query($dbconnect, $get_student); 
    while ($row_otherpayment_paid = mysqli_fetch_array($run_otherpayment_paid)) {
        $amount_topay = $row_otherpayment_paid['amount_topay'];
        $amount_paid = $row_otherpayment_paid['amount_paid'];
        $amount_justpaid = $row_otherpayment_paid['amount_justpaid'];
        $school_payment_ref = $row_otherpayment_paid['school_payment_ref'];
        $paystack_ref = $row_otherpayment_paid['paystack_ref'];
        $mydate = $row_otherpayment_paid['date_time'];
    }
    $var3="-";
    $data_qrcode = $fullname.$var3.$var3.$var3.$unique_id.$var3.$var3.$paystack_ref.$var3.$var3.$var3.$session.$var3.$var3.$var3.$amount_paid.$var3.$var3.$var3;
    

        $url = "https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl={$data_qrcode}";
//                echo $url;
        $output["img"] = $url;
$data['img'] = $url;
    $data = '';
    $data .= '
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            td, th {
                border-bottom: 1px solid #dddddd;
                text-align: left;
                height: 30px;
                line-height: 25px;
            }
            td{
                line-height: 10px;
            }
            .tr {
                background-color: #dddddd;
                
            }
            .watermark {
                background-image: url("images/logo.jpg");
                background-position:center ;
                background-size: 300px;
                background-repeat: no-repeat;
                opacity: 0.1;

            }
            .img_qr {
                float:right;
                margin-right: 10px;
                
            }
        </style>
    </head>
    <body style=";
  background-repeat: repeat-y;" >
    <h1 style="text-align:center; text-transform:uppercase;">Payment Receipt</h1>
    <h4 style="text-transform:uppercase;">Reference ids: ' . $school_payment_ref . '</h4>
    <h4 style="text-transform:uppercase;">Paystack id: ' . $paystack_ref . '</h4>
    <h5>Name: ' .$fullname. '</h5>
    <h5>Unique Number: ' . $unique_id . ' </h5>
    <h5>Department: ' . $class_name . '</h5>
    <h5>Level: ' . $level . '</h5>
    <h5 >Current Session: ' . $session . '</h5>
    <h5 >Date Paid: ' . $mydate . '</h5>
    <!--<h4 style="text-align:right;">Status: <span>' . $status . '</span></h4>-->
    <hr style="color:red; margin-bottom: 20px;"><h1></h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Payment Description</th>
                <th>Total In Detail(Naira)</th>
            </tr>
        </thead>
        <tbody>
            <tr class="tr">
                <td>'.$payment_type.' (Just Paid)</td>
                <td>' . number_format($amount_justpaid) . '</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="1" class="text-right">Total Amount Paid:</th>
                <th class="text-center">' . number_format($amount_paid) . '</th>
            </tr>
        </tfoot>
        <tfoot>
            <tr>
                <th colspan="1" class="text-right">Total Amount to Paid:</th>
                <th class="text-center">' . number_format($amount_topay) . '</th>
            </tr>
        </tfoot>
        <tfoot>
            <tr class="tr">
                
                <th colspan="1" class="text-right">Outstanding: </th>
                <th class="text-center">' . number_format($amount_topay-$amount_paid) . '</th>
               
            </tr>
        </tfoot>
    
    </table>
    <p>This receipt has been verified at bursary. Payment value written and stamped</p><br>__________________<br><br>Bursary Signature and Stamp<br><br>
    <img src="' . $output['img'] . '" alt="" class="img_qr" height="100px">
 

    </body>';
    //============================================================+
    // File name   : example_006.php
    // Begin       : 2008-03-04
    // Last Update : 2013-05-14
    //
    // Description : Example 006 for TCPDF class
    //               WriteHTML and RTL support
    //
    // Author: Nicola Asuni
    //
    // (c) Copyright:
    //               Nicola Asuni
    //               Tecnick.com LTD
    //               www.tecnick.com
    //               info@tecnick.com
    //============================================================+

    /**
     * Creates an example PDF TEST document using TCPDF
     * @package com.tecnick.tcpdf
     * @abstract TCPDF - Example: WriteHTML and RTL support
     * @author Nicola Asuni
     * @since 2008-03-04
     */

    // Include the main TCPDF library (search for installation path).
    require_once('TCPDF-main/config/tcpdf_config.php');
    require_once('TCPDF-main/tcpdf.php');

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('fountain payment receipt');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING);

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

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('Times', '', 12);

    // add a page
    $pdf->AddPage();

    // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
    // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

    // create some HTML content



    // output the HTML content
    $pdf->writeHTML($data, true, false, true, false, '');

    $pdf->lastPage();

    $pdf->Output('payment_receipt.pdf', 'I');
}

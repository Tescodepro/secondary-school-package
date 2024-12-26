<?php
include 'islogin.php';

if (isset($_POST["create_pdf"])) { 
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
    $pdf->SetTitle('AUAS Admission letter');
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
    include "database.php";

    $COLLETPDF = "SELECT * FROM user inner join admission_details on admission_details.app_id=user.assign_id WHERE user.assign_id = '$app_id'";
    $Result = mysqli_query($dbconnect, $COLLETPDF);
    while ($row = mysqli_fetch_array($Result)) {

        $html = '<h1 style="text-align:center; text-transform:uppercase;">PROVISIONAL ADMISSION TO UNDERGRADUATE PROGRAMME</h1>
    <h4 style="text-transform:uppercase;">' .$name. '</h4>
    <h5><b>Application No: </b>' .$app_id. '</h5>
    
    <h5><b>Email: </b>' . $email . ' </h5> 
    <h5><b>Year of Admission: </b> 2021/2022</h5>
    <h4><b>Awarded Course of Study: </b>' . $row["approved_course"] . '</h4>
    Following your application for admission to the University, and consequent upon your academic qualification and satisfactory performance at the screening exercise, I am pleased to inform you that you have been offered provisional admission to Adeleke University, Ede to study <b>' . $row["approved_course"] . '.</b> <br>
    You are to NOTE that your admission is subject to fulfilling the following conditions at Verification point during registration process.<br>    
 1. Evidence of originals and five (5) copies of the underlisted documents;    
    <ul> 
    <li>O/Level result which must include five (5) credits including English and Mathematics plus three other relevant subjects to your course of study at not more than two sittings.</li>
    <li>Print out of JAMB result slip for 2021 with a score not below the minimum cut off mark of 180.</li>
    <li>Birth certificate or sworn affidavit of date of birth;</li>
    <li>Letter of undertaking of good behaviour from your parents/guardian</li>
    <li>Six (6) copies of your recent passport size photograph;</li>
        </ul>
     2.Completion and return of Student files to the respective College Officers within the stipulated period for registration.<br>
    3.	<b>DRESS CODE</b><br>
The University policy prescribed a Shirt on a Pair of trousers with a tie along with a Shoes and Socks for the  Male Students while for the  Female Students, it is  a Long skirt(not above the knee) and a well buttoned Shirt/Blouse with a long sleeve that should be beyond the elbow including head tie/decent scarf cover. (See Students’ Handbook for details).<br>
4.	MEDICAL
You will be required to undergo a  Chest X -ray and a Certified Medical examinations Report at the University Health Centre based on approved fees as part of your registration requirements.</p>
<p>Please be INFORMED that this is a PROVISIONAL admission and your admission letter will be issued after fulfilling physical registration in the University Admission office.
Accept my hearty congratulations on your provisional admission to the university.



    
    
    
    
    
    Yours sincerely,<br>Dr K.W Sallee,<br>Registrar';
    }



    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->lastPage();

    $pdf->Output('AUAS admission letter.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
}

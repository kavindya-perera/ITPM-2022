<?php 
    require 'vendor/autoload.php';

  
    use Dompdf\Dompdf;



            $content = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <style>
                        *{
                            font-family: Arial, Helvetica, sans-serif;
                        }
                        table, td, th {
                            border: 1px solid;
                            padding: 5px;
                            text-align: left;
                        }
                
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }
                        .center{
                            text-align: center;
                            background-color: black;
                            color: white;
                            border: 1px solid;
                        }
                        .center1{
                            text-align: center;
                            border: 1px solid;
                        }
                
                        .footer {
                            position: fixed;
                            left: 0;
                            bottom: 0;  
                            width: 100%;
                            background-color: #dbdbdb;
                            color: black;
                            text-align: center;
                            padding-top: 3px;
                            padding-bottom: 3px;
                        }
                        .verify{
                            margin-top: 30px;
                        }
                    </style>
                </head>
                <body>
                    <h2 align="center">Wayamba IT Campus Student Payment Report</h2>
                
                    <b>Class - </b> '.$payments[0]->C_NAME.' <br><br>
                
                    <table>
                        <tr>
                            <th class="center1" colspan="4">Student Details </th>
                        </tr>
                        <tr>
                            <th class="center">Subject</th>
                            <th colspan="3" class="center">Details</th>
                        </tr>
                        <tr>
                            <th>Student Number</th>
                            <td colspan="3">'.$payments[0]->S_NUMBER.'</td> 
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td colspan="3">'.$payments[0]->S_FULL_NAME.'</td> 
                        </tr>
                        <tr>
                            <th>NIC Number</th>
                            <td colspan="3">'.$payments[0]->S_NIC.'</td> 
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td colspan="3">'.$payments[0]->S_GENDER.'</td> 
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>'.$payments[0]->S_CONTACT_NUMBER_1.' | '.$payments[0]->S_CONTACT_NUMBER_2.'</td> 
                            <th>Whatsapp</th>
                            <td>'.$payments[0]->S_WHATSAPP_NUMBER.'</td> 
                        </tr>
                    </table>
                
                <br>
                    <table>
                        <tr>
                            <th class="center1" colspan="5">Payment Details </th>
                        </tr>
                        <tr>
                            <th class="center">#</th>
                            <th class="center">Invoice No</th>
                            <th  class="center">Date</th>
                            <th  class="center">Description</th>
                            <th  class="center">Amount (LKR )</th>
                        </tr>';



                            $count =0;
                            $total=0;
                            foreach($payments AS $payment):
                                $count++;
                
                            $content.='   <tr>
                                            <td>'.$count.'</td>
                                            <td>'.$payment->SP_INVOICE_NO.'</td> 
                                            <td>'.$payment->SP_DATE.'</td> 
                                            <td>'.$payment->SP_FOR.'</td> 
                                            <td>'.number_format($payment->SP_AMOUNT,2).'</td> 
                                        </tr>';
                            $total = $total+$payment->SP_AMOUNT;
                            endforeach;
                     
                $content.='
                            <tr>
                                <td colspan="3"></td>
                                <th>Total</th>
                                <td>'.number_format($total,2).'</td>
                            </tr>
                </table>
                    <div class="verify">
                        <p>____________________________________</p>
                        <p>verify by</p>
                    </div>
                
                    <div class="footer">
                        This document generated from witc.lk | '.date("m.d.Y").'
                    </div>
                
                </body>
                </html>';



            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml(
                $content
            );
        
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
        
            // Render the HTML as PDF
            $dompdf->render();
        
            // Output the generated PDF to Browser
            $dompdf->stream('Student-Payment-Details-'.$payments[0]->S_NUMBER);


                ?>










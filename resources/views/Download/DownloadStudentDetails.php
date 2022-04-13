<?php 
    require 'vendor/autoload.php';

    $Status = 'Active';
    if($student[0]->S_STATUS == 0){
        $Status = 'Disabled';
    }
    use Dompdf\Dompdf;

            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml(
                '<!DOCTYPE html>
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
                            margin-top: 70px;
                        }
                    </style>
                </head>
                <body>
                    <h2 align="center">Wayamba IT Campus Student Details</h2>
                
                    <b>Class - </b> '.$student[0]->C_NAME.' <br><br>
                
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
                            <td colspan="3">'.$student[0]->S_NUMBER.'</td> 
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td colspan="3">'.$Status.'</td> 
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td colspan="3">'.$student[0]->S_FIRST_NAME.'</td> 
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td colspan="3">'.$student[0]->S_LAST_NAME.'</td> 
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td colspan="3">'.$student[0]->S_FULL_NAME.'</td> 
                        </tr>
                        <tr>
                            <th>NIC Number</th>
                            <td colspan="3">'.$student[0]->S_NIC.'</td> 
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td colspan="3">'.$student[0]->S_AGE.'</td> 
                        </tr>
                        <tr>
                            <th>Birthday</th>
                            <td colspan="3">'.$student[0]->S_BIRTHDAY.'</td> 
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td colspan="3">'.$student[0]->S_GENDER.'</td> 
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>'.$student[0]->S_CONTACT_NUMBER_1.' | '.$student[0]->S_CONTACT_NUMBER_2.'</td> 
                            <th>Whatsapp</th>
                            <td>'.$student[0]->S_WHATSAPP_NUMBER.'</td> 
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td colspan="3">'.$student[0]->S_EMAIL.'</td> 
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td colspan="3">'.$student[0]->S_ADDRESS.'</td> 
                        </tr>
                    </table>
                
                <br><br>
                    <table>
                        <tr>
                            <th class="center1" colspan="2">Parent Details </th>
                        </tr>
                        <tr>
                            <th class="center">Subject</th>
                            <th  class="center">Details</th>
                        </tr>
                        <tr>
                            <th>Full Name</th>
                            <td>'.$student[0]->S_P_NAME.'</td> 
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>'.$student[0]->S_P_CONTACT_NUMBER.'</td> 
                        </tr>
                     
                    </table>
                
                
                    <div class="verify">
                        <p>____________________________________</p>
                        <p>verify by</p>
                    </div>
                
                    <div class="footer">
                        This document generated from witc.lk | '.date('m.d.Y').'
                    </div>
                
                </body>
                </html>'
            );
        
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
        
            // Render the HTML as PDF
            $dompdf->render();
        
            // Output the generated PDF to Browser
            $dompdf->stream('Student-Details-'.$student[0]->S_NUMBER);
?>


